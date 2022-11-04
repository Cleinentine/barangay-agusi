<div>
    <h2>My Account</h2>

    <form action="app/update-account.php" class="top-gap" method="POST">
        <div class="grid grid-cols-2 grid-gap">
            <div class="col">
                <label>Email <span class="required">(Required)</span>:</label>

                <div class="icon-container">
                    <input name="email" placeholder="e.g. johnsmith@gmail.com" type="email" value="<?= $user['email']; ?>">

                    <span><i class="fa-solid fa-at"></i></span>
                </div>
            </div>

            <div class="col">
                <label>Mobile Number:</label>

                <div class="icon-container">
                    <input name="mobile_number" placeholder="e.g. 09265121114" type="text" value="<?= $user['mobile_number']; ?>">

                    <span><i class="fa-solid fa-mobile-screen"></i></span>
                </div>
            </div>
        </div>

        <div class="text-center small-top-gap">
            <button name="update_account" type="submit"><i class="fa-solid fa-pen-to-square"></i> Update Account</button>
        </div>
    </form>
</div>
