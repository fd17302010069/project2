function turnPageForSearch(pageNum) {
    let sortValue=$("input[name='sort']:checked").val();
    if(sortValue !== undefined){
        $("section").load("searchFunctions.php",
            {search:$("#search").val(),
                search_option:getOptionValue(),
                sort:sortValue,
                page:pageNum
            });
    }
    else{
        $("section").load("searchFunctions.php",
            {search:$("#search").val(),
                search_option:getOptionValue(),
                page:pageNum
            });
    }
}

function turnPageForCart(pageNum) {
    $("#cart_content").load("shoppingCartContents.php",{page:pageNum});
}