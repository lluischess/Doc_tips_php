<?php

// 1 Set document root to YOUR_PROJECT/public, that way the site is loaded from public/index.php
// - You should include/require all other files in index.php, that's your main file
// - You can use APP_PATH, FILES_PATH & VIEWS_PATH constants that are defined in index.php to help you with including files

// 2 Main code should go in app directory in any file that you choose, I created empty App.php that you can use to place your main logic but feel free to change it
// - You should define multiple functions there which will read all files within transaction_files directory and process them. It is up to you how you want to read those files, but the goal is to read all files within that directory
// - You can assume that all files within transaction_files directory are .csv files
// - One sample file is provided which contains formatted data
// - You can assume that all files in transaction_files directory will be of same format for now

// 3 Store data in memory (in an array)
// - First column is the date of the transaction
// - Second column is the check # which is optional & is not always provided
// - The third column is transaction description
// - The fourth column is the amount (negative number indicates it's an expense, positive number indicates it's an income)

// 4 Calculate the total income, total expense & net total (total income - total expense)

// 5 Print a simple HTML table containing all the data from the files
// - The html skeleton is provided in views/transactions.php file
// - The date of the transaction should be in this format "Jan 4, 2021"
// - Show income amounts in green color & show expense amounts in red
