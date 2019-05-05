define([], function () {
    var mageJsComponent = function(config)
    {
        console.log("Js2 file run immediately although it returned a function");
        console.log(config);
    };

    return mageJsComponent;
});
