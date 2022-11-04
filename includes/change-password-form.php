<div class="massive-top-gap">
    <h2>Change Password</h2>

    <form action="app/change-account-password.php" class="top-gap" method="POST">
        <div class="grid grid-cols-2 grid-gap">
            <div class="col">
                <label>New Password <span class="required">(Required)</span>:</label>

                <div class="icon-container">
                    <input name="new_password" type="password">

                    <span><i class="fa-solid fa-key"></i></span>
                </div>
            </div>

            <div class="col">
                <label>Confirm New Password <span class="required">(Required)</span>:</label>

                <div class="icon-container">
                    <input name="confirm_new_password" type="password">

                    <span><i class="fa-solid fa-rotate-right"></i></span>
                </div>
            </div>
        </div>

        <div class="text-center small-top-gap">
            <button name="change_account_password" type="submit"><i class="fa-solid fa-pen-to-square"></i> Change Password</button>
        </div>
    </form>
</div>
