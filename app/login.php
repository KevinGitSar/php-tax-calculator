<?php
include "view/header.php";
?>

<div class="mx-auto w-1/2">
    
    <h1 class="text-center">Login!</h1>

    <div class="pt-5">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
    </div>

    <div class="pt-5">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
    </div>
</div>

<?php include 'view/footer.php'; ?>