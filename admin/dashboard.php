<?php
include_once "header.php";
include_once "../db.php";

// ---------------------- TOTAL SALES QUERY ----------------------
$sql = "
    SELECT SUM(h.price * DATEDIFF(b.checkout_date, b.checkin_date)) AS total_sales
    FROM hotelbookings b
    INNER JOIN hotels h ON b.hotel_id = h.id
    WHERE b.payment_status = 'Paid Successfully'
";
$result = $conn->query($sql);

$total_sales = 0;
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_sales = $row['total_sales'];
}

// ---------------------- TOTAL BOOKINGS ----------------------
$total_query = "SELECT COUNT(*) AS total FROM hotelbookings";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_bookings = $total_row['total'];

// ---------------------- FETCH USERS ----------------------
$Userquery = "SELECT id, fullname, email, avatar FROM users ORDER BY id DESC";
$usersData = mysqli_query($conn, $Userquery);

// ---------------------- FETCH TRANSACTIONS ----------------------
$transactionQuery = "
    SELECT p.id, p.amount, p.method, p.status, p.created_at, u.fullname
    FROM payments p
    JOIN users u ON p.user_id = u.id
    ORDER BY p.created_at DESC
";
$transaction = mysqli_query($conn, $transactionQuery);
?>

<div class="container">
  <div class="page-inner">
    <!-- Page Header -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4 mt-5">
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <h6 class="op-7 mb-2">Welcome to Admin Dashboard (Total Bookings: <?php echo $total_bookings; ?>)</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
        <a href="#" class="btn btn-primary btn-round">Add Customer</a>
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
      <!-- Orders -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-shopping-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Orders</p>
                  <h4 class="card-title"><?php echo $total_bookings; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Subscribers -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Subscribers</p>
                  <h4 class="card-title">1303</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Sales -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-dollar-sign"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Sales</p>
                  <h4 class="card-title">$<?php echo number_format($total_sales, 2); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Successful Orders -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Completed Orders</p>
                  <h4 class="card-title"><?php echo $total_bookings; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Customers & Transactions -->
    <div class="row">
      <!-- New Customers -->
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-body">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">New Customers</div>
            </div>
            <div class="card-list py-4">
              <?php while ($user = mysqli_fetch_assoc($usersData)) {
                // Avatar or initials
                $avatarHtml = !empty($user['avatar'])
                  ? '<img src="../' . $user['avatar'] . '" alt="..." class="avatar-img rounded-circle" />'
                  : '<span class="avatar-title rounded-circle border border-white bg-primary">' . strtoupper(substr($user['fullname'], 0, 1)) . '</span>';
                ?>
                <div class="item-list d-flex align-items-center mb-3">
                  <div class="avatar">
                    <?php echo $avatarHtml; ?>
                  </div>
                  <div class="info-user ms-3">
                    <div class="username"><?php echo htmlspecialchars($user['fullname']); ?></div>
                    <div class="status"><?php echo htmlspecialchars($user['email']); ?></div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-icon btn-link op-8 me-1">
                      <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                      <i class="fas fa-ban"></i>
                    </button>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Transaction History -->
      <div class="col-md-8">
        <div class="card card-round shadow-sm">
          <div class="card-header bg-white border-0">
            <h4 class="card-title fw-bold mb-0">Transaction History</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr style="background-color:#f8f9fa;">
                    <th style="font-weight:600; padding:15px;">PAYMENT NUMBER</th>
                    <th style="font-weight:600; padding:15px;">DATE & TIME</th>
                    <th style="font-weight:600; padding:15px;">AMOUNT</th>
                    <th style="font-weight:600; padding:15px;">STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($transaction) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($transaction)): ?>
                      <tr style="border-bottom:1px solid #f1f1f1;">
                        <!-- Payment Number -->
                        <td style="padding:15px;">
                          <?php if ($row['status'] == 'Success'): ?>
                            <i class="fas fa-check-circle" style="color:#28a745; font-size:18px;"></i>
                          <?php else: ?>
                            <i class="fas fa-hourglass-half" style="color:#ffc107; font-size:18px;"></i>
                          <?php endif; ?>
                          <span style="font-weight:600; margin-left:10px;">
                            Payment from #<?php echo $row['id']; ?>
                          </span>
                        </td>

                        <!-- Date & Time -->
                        <td style="padding:15px; color:#555;">
                          <?php echo date("M d, Y, g:ia", strtotime($row['created_at'])); ?>
                        </td>

                        <!-- Amount -->
                        <td style="padding:15px; font-weight:600; color:#000;">
                          $<?php echo number_format($row['amount'], 2); ?>
                        </td>

                        <!-- Status -->
                        <td style="padding:15px;">
                          <?php if ($row['status'] == 'Success'): ?>
                            <span class="badge"
                              style="background-color:#28a745; color:white; font-size:13px; padding:7px 15px; border-radius:8px;">
                              Completed
                            </span>
                          <?php else: ?>
                            <span class="badge"
                              style="background-color:#ffc107; color:white; font-size:13px; padding:7px 15px; border-radius:8px;">
                              Pending
                            </span>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4" class="text-center py-4" style="color:#888;">
                        No transactions found.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
                    
    </div>
  </div>
</div>

<?php include_once "footer.php"; ?>