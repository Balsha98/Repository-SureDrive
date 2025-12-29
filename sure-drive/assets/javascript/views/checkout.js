import { unsetCookie } from "./../helpers/cookie.js";

// ***** DOM ELEMENTS ***** //
const formInputDivs = $(".div-form-inputs-container");
const confirmPaymentBtn = $(".btn-confirm-payment");
const nextStepBtns = $(".btn-next-step");
const prevStepBtns = $(".btn-previous-step");
const resetBtns = $(".btn-reset");

// Variables.
const orderInputs = [
  "car_id",
  "seller_id",
  "owner_id",
  "car_name",
  "make",
  "model",
  "year",
  "car_image",
  "mileage",
  "shift",
  "final_price",
  "total_price",
  "first_name",
  "last_name",
  "order_email",
  "order_phone",
  "shipping_address",
  "apt_number",
  "country",
  "city",
  "zip",
];

// ***** FUNCTIONS ***** //
const checkInputs = function (inputs) {
  let isEmpty = false;
  for (const input of inputs) {
    if ($(input).val() === "") {
      $(input).addClass("empty-field");
      isEmpty = true;
    } else {
      $(input).removeClass("empty-field");
    }
  }

  return isEmpty;
};

const toNextStep = function () {
  const stepIndex = +$(this).data("step-index");

  // Get parent container.
  const parent = [...formInputDivs].find(
    (form) => +$(form).data("form-index") === stepIndex - 1
  );
  const parentClass = $(parent).attr("class").split(" ")[1];
  const requiredInputs = $(`.${parentClass} .required-input-container input`);
  if (checkInputs(requiredInputs)) return;

  // Else move on.
  $(parent).addClass("hide-element");

  // Get next container.
  const nextFormContainer = [...formInputDivs].find(
    (form) => +$(form).data("form-index") === stepIndex
  );
  $(nextFormContainer).removeClass("hide-element");

  // Get next container's parent into view.
  nextFormContainer.closest(".div-form-process-container").scrollIntoView();
};

const toPreviousStepS = function () {
  const stepIndex = +$(this).data("step-index");

  // Get parent container
  const prevFormContainer = [...formInputDivs].find(
    (form) => +$(form).data("form-index") === stepIndex
  );
  $(prevFormContainer).removeClass("hide-element");

  // Get previous container's parent into view.
  prevFormContainer.closest(".div-form-process-container").scrollIntoView();

  // Get parent container.
  const parent = [...formInputDivs].find(
    (form) => +$(form).data("form-index") === stepIndex + 1
  );
  $(parent).addClass("hide-element");
};

const confirmPayment = function (event) {
  event.preventDefault();

  const form = $(this.closest(".form"));
  const url = form.attr("action");
  const method = form.attr("method");

  const data = {};
  for (const input of orderInputs) {
    data[`${input}`] = $(`#${input}`).val();
  }

  handleRequest(url, method, "/checkout", data);
  unsetCookie("last_viewed_car");
};

const resetFields = function () {
  const parent = $(this.closest(".div-form-inputs-container"));
  const relParentClass = parent.attr("class").split(" ")[1];
  $(`.${relParentClass} input`).each((_, input) => {
    if ($(input).hasClass("empty-field")) {
      $(input).removeClass("empty-field");
    }

    $(input).val("");
  });

  // Visual appearance.
  let degrees = +$(this).data("rotate");
  $(this).css("transform", `rotate(${(degrees += 360)}deg)`);
  $(this).data("rotate", degrees);
};

// ***** EVENT LISTENERS ***** //
nextStepBtns.each((_, btn) => {
  $(btn).click(toNextStep);
});

prevStepBtns.each((_, btn) => {
  $(btn).click(toPreviousStepS);
});

resetBtns.each((_, btn) => {
  $(btn).click(resetFields);
});

// Confirming the payment.
confirmPaymentBtn.click(confirmPayment);
