<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="mb-5">
            <a href="/notes" class="text-blue-500 hover:underline">⬅ Go back</a>
        </p>    
        
        <p><?= htmlspecialchars($note['body'])?></p>

        <div class="flex items-center justify-start gap-x-6 mt-6">
        
            <a href="note/edit?id=<?=$note['id']?>" class="text-blue-500 font-bold">Edit</a>

            <form method="POST">
                <input type="hidden" value="delete" name="_method">
                <input type="hidden" value="<?=$note['id']?>" name="id">
                <button onclick="return confirm('h̴̢̨̗̣̱̜̻̫̯̪̼͚̤̙͙͔͓̫̭͙͎̩̠͕̥͚͍̋̅͋̉͛̈́̆̾̔̑̐̉̄̈́̂̽͗͜͝ę̴̘̤̭̪̦̖̭͓͓̰̭̟̳̱̹̲͉̭̞͙̞̰̪͉̂̒́̆̌͌̆͐̑͌͊́̆̉́̚͝l̵̡̨̥̹͇̝̰̣͉̘͙̘͔͎̖̤̱͇͍̗̼̮͎̈́̈́̓̃̔͒͂͑̑̈́͝ͅp̶̧̨̫̗͇̻̟̮̖̯͔̭̘̞͕̤̙̘̻͍̫̗̙̖̮̙̲̝̯̟̮̔̈́̌̀̓̿͋̔̈́̈́͛̓̓̆͛̚ͅ')" class="text-bold font-bold text-red-500">Delete</button>
            </form>

        </div>
        
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>