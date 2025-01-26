import { openPage } from "./general.js";

// ***** FUNCTIONS ***** //
const handleRequest = function (url, method, route, data, dataType = "json") {
    $.ajax({
        url: url,
        type: method,
        data: dataType === "json" ? JSON.stringify(data) : data,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (route === "/login" || route === "/signup") {
                if (!response["logged_in"]) {
                    return;
                }

                openPage($(".btn-form-submit"));
            }

            if (route === "/home") {
                const filteredCars = JSON.parse(response);
                const textNoCarsFound = $(".text-no-cars-found");
                const carsGridContainer = $(".div-cars-grid-container");
                const currAvailableCars = $(".div-car-card-container");
                currAvailableCars.each((_, car) => $(car).addClass("hide-element"));

                if (filteredCars.length === 0) {
                    if (textNoCarsFound) textNoCarsFound.remove();
                    carsGridContainer.addClass("center-grid-data");

                    carsGridContainer.append(`
                        <p class='text-no-cars-found'>
                            Cars with the <span>selected filters</span> are currently <span>not</span> available.
                        </p>    
                    `);

                    return;
                }

                if (carsGridContainer.hasClass("center-grid-data")) {
                    carsGridContainer.removeClass("center-grid-data");
                    textNoCarsFound.remove();
                }

                filteredCars.forEach((carObj) => {
                    const id = carObj["car_id"];
                    currAvailableCars.each((_, car) => {
                        if (+$(car).data("car-id") === id) {
                            $(car).removeClass("hide-element");
                        }
                    });
                });
            }

            if (route === "/checkout") {
                setTimeout(() => {
                    openPage($(".btn-confirm-payment"));
                }, 3000);
            }
        },
    });
};

export { handleRequest };
