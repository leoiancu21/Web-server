var app = {
    baseURL: "./data.php",
    productList: {},
    init: function () {
        console.log("init here!");
        $("title").text("Web app template");
        // Get the product list from the database
        app.getProductList();
    },
    getProductList: function() {
        // make a HTTP GET request
        $.getJSON(`${app.baseURL}`)
        .done(app.onSuccess)
        .fail(app.onError);
    },
    onSuccess: function (jsonData) {
        console.log(jsonData);
        // save data in a local variable
        app.productList = jsonData.productList;

        let item = app.productList[0];
        $(".card-title>a".html(item.name);
    },
    onError: function (e) {
        console.log("error!");
        console.log(JSON.stringify(e));
    }
};

$(document).ready(app.init);
