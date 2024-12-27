import { handleRequest } from "./request.js";

// ***** DOM ELEMENTS ***** //
const formSubmitBtn = $(".btn-form-submit");

// ***** EVENT LISTENERS ***** //
formSubmitBtn.click(function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const url = form.attr("action");
    const method = form.attr("method");

    const data = {};
    data["username"] = $("#username").val();
    data["password"] = $("#password").val();

    handleRequest(url, method, "/login", data);
});
