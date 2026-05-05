<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searchable Listing Page</title>
    <style>
        .item {
            padding: 8px;
            margin: 4px;
            border: 1px solid #ccc;
        }
        #noResults {
            color: red;
            display: none;
        }
    </style>
</head>
<body>

    <h1>Product Listings</h1>

    <input type="text" id="searchBox" placeholder="Search for products..." onkeyup="searchItems()">
    <p id="noResults">No products found</p>

    <div id="itemList">
        <div class="item">Apple - $2</div>
        <div class="item">Banana - $1</div>
        <div class="item">Orange - $3</div>
        <div class="item">Grapes - $4</div>
        <div class="item">Pineapple - $5</div>
        <div class="item">Mango - $2.5</div>
    </div>

    <script>
        // JavaScript function to handle the search
        function searchItems() {
            const searchTerm = document.getElementById('searchBox').value.toLowerCase();
            const items = document.querySelectorAll('.item');
            let found = false;

            items.forEach(item => {
                // If the item text includes the search term, show it, otherwise hide it
                if (item.textContent.toLowerCase().includes(searchTerm)) {
                    item.style.display = 'block';  // Show matching item
                    found = true;
                } else {
                    item.style.display = 'none';  // Hide non-matching item
                }
            });

            // Show message if no results found
            const noResults = document.getElementById('noResults');
            if (!found && searchTerm !== '') {
                noResults.style.display = 'block';  // Show no results message
            } else {
                noResults.style.display = 'none';  // Hide no results message
            }
        }
    </script>

</body>
</html>
