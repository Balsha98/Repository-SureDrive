import { handleRequest } from "../helpers/request.js";

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
  data["user_email"] = $("#user_email").val();
  data["password"] = $("#password").val();
  data["role_id"] = $("#role_id").val();

  handleRequest(url, method, "/signup", data);
});
