<?php
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first.";
    header("Location: index.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    echo "<p>Invalid request.</p>";
    exit();
}

$booking_id = intval($_GET['booking_id']);
$query = mysqli_query($conn, "
    SELECT b.*, h.name, h.price, h.location 
    FROM hotelBookings b
    JOIN hotels h ON b.hotel_id = h.id
    WHERE b.id = '$booking_id'
");
$booking = mysqli_fetch_assoc($query);

// Calculate nights
$checkin = new DateTime($booking['checkin_date']);
$checkout = new DateTime($booking['checkout_date']);
$interval = $checkin->diff($checkout);
$nights = $interval->days;

// Final amount (in INR)
$price_per_night = $booking['price'];
$total_amount = $price_per_night * $nights;

// UPI QR Code
$upi_id = "avadhnarola2515@oksbi";
$payee_name = "HotelBooking";
$qrData = "upi://pay?pa=$upi_id&pn=$payee_name&am=$total_amount&cu=INR";
$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($qrData);
?>

<div class="container" style="margin-top: 120px; margin-bottom: 50px; max-width:650px;">
    <div class="payment-card">
        <h2 class="text-center mb-4"><i class="fas fa-credit-card" style="color:#28a745;"></i> Secure Payment</h2>

        <!-- Booking Summary -->
        <div class="booking-summary mb-4">
            <p><i class="fas fa-hotel" style="color:#007bff;"></i> <strong>Hotel:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
            <p><i class="fas fa-map-marker-alt" style="color:#e63946;"></i> <strong>Location:</strong> <?php echo htmlspecialchars($booking['location']); ?></p>
            <p><i class="fas fa-calendar-check" style="color:#17a2b8;"></i> <strong>Check-in:</strong> <?php echo htmlspecialchars($booking['checkin_date']); ?></p>
            <p><i class="fas fa-calendar-times" style="color:#ff6f00;"></i> <strong>Check-out:</strong> <?php echo htmlspecialchars($booking['checkout_date']); ?></p>
            <p><i class="fas fa-moon" style="color:#6f42c1;"></i> <strong>Nights:</strong> <?php echo $nights; ?></p>
            <p><i class="fas fa-tag" style="color:#20c997;"></i> <strong>Price per Night:</strong> ₹<?php echo $price_per_night; ?></p>
            <p><i class="fas fa-wallet" style="color:#28a745;"></i> <strong>Final Amount:</strong> 
                <span style="color:#28a745; font-weight:bold;">₹<?php echo $total_amount; ?></span>
            </p>
        </div>

        <!-- Payment Option Selection -->
        <div class="payment-options text-center mb-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQR4ArUxtci1ip0bL0K9hs9QtwcJGy_gu9iYA&s" class="payment-option" id="netbanking-btn" alt="Net Banking / QR">
            <img src="https://cdn-icons-png.flaticon.com/512/6963/6963703.png" class="payment-option" id="creditcard-btn" alt="Credit Card">
        </div>

        <!-- Credit Card Form -->
        <div id="creditcard-form" style="display:none;">
            <form method="post" action="process_payment.php">
                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                <input type="hidden" name="amount" value="<?php echo $total_amount; ?>">

                <div class="form-group mb-3">
                    <label><i class="far fa-credit-card"></i> Card Number</label>
                    <input type="text" name="card_number" class="form-control card-input" maxlength="19" placeholder="1234 5678 9012 3456" required>
                </div>

                <div class="form-row d-flex mb-3">
                    <div class="form-group col-md-6 pr-2">
                        <label><i class="fas fa-calendar-alt"></i> Expiry Date</label>
                        <input type="text" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                    </div>
                    <div class="form-group col-md-6 pl-2">
                        <label><i class="fas fa-lock"></i> CVV</label>
                        <input type="password" name="cvv" class="form-control" maxlength="4" placeholder="***" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label><i class="fas fa-user"></i> Card Holder Name</label>
                    <input type="text" name="card_name" class="form-control" placeholder="John Doe" required>
                </div>

                <button type="submit" class="custom-btn btn-block">
                    <i class="fas fa-check-circle"></i> Pay ₹<?php echo $total_amount; ?>
                </button>
            </form>
        </div>

        <!-- Net Banking / QR Code -->
        <div id="netbanking-form" class="text-center" style="display:none;">
            <h4><i class="fas fa-qrcode" style="color:#17a2b8;"></i> Scan & Pay</h4>
            <p>Pay <strong>₹<?php echo $total_amount; ?></strong> securely via UPI</p>
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code" style="max-width:250px; border:5px solid #f1f1f1; border-radius:10px;">
            <p class="mt-3 text-muted">After payment, click the button below to confirm.</p>
            <button class="custom-btn">I Have Paid</button>
        </div>

        <div class="text-center mt-4 secure-note">
            <i class="fas fa-lock"></i> Your payment is encrypted & secure
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    body {
        background: #f8f9fa;
    }

    /* Main card */
    .payment-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        padding: 35px;
        transition: all 0.3s ease-in-out;
    }
    .payment-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.2);
    }

    /* Booking Summary */
    .booking-summary {
        background: #f1f9ff;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #d9e9f7;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .booking-summary:hover {
        box-shadow: 0 4px 15px rgba(66, 133, 244, 0.25);
    }

    /* Buttons */
    .custom-btn {
        border-radius: 12px;
        padding: 12px 20px;
        font-size: 18px;
        background: linear-gradient(45deg, #28a745, #218838);
        color: #fff;
        font-weight: bold;
        border: none;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
    }
    .custom-btn:hover {
        background: linear-gradient(45deg, #218838, #1e7e34);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 25px rgba(40, 167, 69, 0.55);
    }

    /* Inputs */
    .form-control {
        border-radius: 10px;
        padding: 12px;
        font-size: 15px;
        box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
    }

    /* Payment Options */
    .payment-options img {
        width: 70px;
        margin: 0 15px;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }
    .payment-options img:hover {
        transform: scale(1.08);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.25);
    }

    .secure-note {
        font-size: 14px;
        color: #28a745;
        font-weight: 500;
    }
    .card-input {
        letter-spacing: 2px;
        font-weight: bold;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cardInput = document.querySelector(".card-input");
        if (cardInput) {
            cardInput.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, "").substring(0, 16);
                let formattedValue = value.replace(/(.{4})/g, "$1 ").trim();
                e.target.value = formattedValue;
            });
        }

        // Toggle payment options
        document.getElementById("netbanking-btn").addEventListener("click", function () {
            document.getElementById("netbanking-form").style.display = "block";
            document.getElementById("creditcard-form").style.display = "none";
        });

        document.getElementById("creditcard-btn").addEventListener("click", function () {
            document.getElementById("creditcard-form").style.display = "block";
            document.getElementById("netbanking-form").style.display = "none";
        });
    });
</script>
