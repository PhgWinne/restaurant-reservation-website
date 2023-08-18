<?php include('partials/head.php'); ?>

<div class="confirm">
    <div class="cf-box">
        <div class="confirm-rsv">
            <img src="<?php $siteurl; ?>images/home/confirm.png" style="width: 50px;">
            <h3 class="heading yellow">Booking Successfully!</h3>
            <h3 class="heading-days" style="color: white;">Thank you for your reservation, you will recieve a confirmation email shortly.</h3>
            <h3 class="heading-days" style="color: white;">Gau's Village look forward to see you!</h3>
            <div class="cf-btn">
                <a href="<?php echo $siteurl; ?>menu.php" class="cf-rsv">Ordering the meal</a>
                <a href="<?php echo $siteurl; ?>" class="cf-rsv">Exit</a>
            </div>
            
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>