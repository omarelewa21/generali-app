import Sortable from "sortablejs";

const specificPageURLs = ["financial-priorities", "savings/goals"];

const currentURL = window.location.href;

if (specificPageURLs.some(url => currentURL.endsWith(url))) {
  const data = $("#topPrioritiesButtonInput").length ? $("#topPrioritiesButtonInput").val() : $("#savingsGoalsButtonInput").val();
  updateMobileFields();

  function nullIfNone(value) {
    if (!value) return null;
    if (value === "" || value === null || value === "null") return null;
    return value;
  }

  function updateMobileFields(newArray = null) {
    let allNull = true;
    newArray
      ? newArray.map(function (value, index) {
          if (value) {
            allNull = false;
          }
        })
      : $("#sortablemobile")
          .children("li.ui-state-default")
          .toArray()
          .map(function (value, index) {
            if ($(value).data("identifier")) {
              allNull = false;
            }
          });
    let data =
      newArray ??
      $("#sortablemobile")
        .children("li.ui-state-default")
        .toArray()
        .map(function (value, index) {
          return allNull ? null : nullIfNone($(value).data("identifier"));
        });
    data = Array($("#topPrioritiesButtonInput").length ? 8 : 4)
      .fill(null)
      .map((value, index) => nullIfNone(data[index]));
    let liElems = [];
    let priorityMap = priority;

    const newData = data.map(function (value, index) {
      const liElem = document.createElement("li");
      liElem.classList.add("ui-state-default", "dropdown", "d-flex", "align-items-center");
      value && liElem.setAttribute("data-identifier", value);
      if (!value) {
        liElem.classList.add("is-empty");
      }

      const iconElem = document.createElement("span");
      iconElem.classList.add("arrowIcon", "draggable-li");
      iconElem.setAttribute("data-bs-toggle", "dropdown");
      iconElem.setAttribute("aria-expanded", "false");
      iconElem.setAttribute("data-attribute", value);
      iconElem.setAttribute("data-index", index);
      iconElem.innerHTML = '<i class="fa-solid fa-chevron-down"></i>';
      liElem.appendChild(iconElem);

      if (value) {
        const draggableLi = document.createElement("div");
        draggableLi.classList.add("d-flex", "align-items-center", "flex-grow-1");

        const imgElem = document.createElement("img");
        imgElem.classList.add("needs-icon");
        imgElem.setAttribute("src", `/images/${$("#topPrioritiesButtonInput").length || value == "others" ? "top-priorities" : "needs/savings/goals"}/${$("#topPrioritiesButtonInput").length || value == "others" ? value + "-icon" : value}.png`);
        draggableLi.appendChild(imgElem);
        const textElem = document.createElement("div");
        textElem.setAttribute("class", "sortable-text fw-bold");
        textElem.innerHTML = `${priorityMap[value]}`;
        draggableLi.appendChild(textElem);

        liElem.appendChild(draggableLi);
      } else {
        const textElem = document.createElement("div");
        textElem.classList.add("d-flex", "align-items-center", "flex-grow-1");
        // textElem.addClass('handle');
        textElem.innerHTML = `${index + 1}`;
        liElem.appendChild(textElem);
      }

      const dropdownElem = document.createElement("ul");
      dropdownElem.classList.add("dropdown-menu", "p-0", "overflow-y-scroll");
      dropdownElem.setAttribute("style", "max-height: 400px;");
      liElem.appendChild(dropdownElem);
      liElems.push(liElem);

      return value;
    });

    $("#sortablemobile").html(liElems);

    if ($("#topPrioritiesButtonInput").length) {
      $("#topPrioritiesButtonInput").val(JSON.stringify(newData));
    } else {
      $("#savingsGoalsButtonInput").val(JSON.stringify(newData));
    }
  }

  $(function () {
    new Sortable($("#sortablemobile").get(0), {
      handle: ".draggable-li",
      animation: 200,
      onSort: function (event, ui) {
        updateMobileFields();
      }
    });

    $("#sortablemobile").on("click", ".arrowIcon", function () {
      const dropdownElem = $(this).closest("li.ui-state-default").find(".dropdown-menu");
      dropdownElem.html("");

      const priorityMap = priority;
      const data = JSON.parse($("#topPrioritiesButtonInput").length ? $("#topPrioritiesButtonInput").val() : $("#savingsGoalsButtonInput").val());
      const index = $(this).data("index");
      const options = [];
      Object.keys(priorityMap).map(function (value) {
        if (data.includes(value)) {
          return;
        }
        const optionElem = document.createElement("li");
        optionElem.classList.add("p-0", "updateIndex", "border-2", "border-bottom", "m-0");
        optionElem.setAttribute("role", "button");
        optionElem.setAttribute("data-value", value);
        optionElem.setAttribute("data-index", index);

        const innerWithImage = document.createElement("a");
        innerWithImage.classList.add("dropdown-item", "d-flex", "align-items-center", "justify-content-start", "p-0");
        const imgElem = document.createElement("img");
        imgElem.classList.add("needs-icon");
        imgElem.setAttribute("src", `/images/${$("#topPrioritiesButtonInput").length || value == "others" ? "top-priorities" : "needs/savings/goals"}/${$("#topPrioritiesButtonInput").length || value == "others" ? value + "-icon" : value}.png`);
        innerWithImage.appendChild(imgElem);
        const textElem = document.createElement("span");
        textElem.innerHTML = priorityMap[value];
        innerWithImage.appendChild(textElem);
        optionElem.appendChild(innerWithImage);

        // return optionElem;
        options.push(optionElem);
      });

      if (options.length) {
        dropdownElem.append(...options);
      } else {
        const noOptions = document.createElement("li");
        noOptions.classList.add("p-2");
        noOptions.setAttribute("disabled", "disabled");
        noOptions.setAttribute("style", "color: #6c757d;");
        noOptions.innerHTML = "No options available";
        dropdownElem.append(noOptions);
      }
      dropdownElem.addClass("dropdown-transform");
    });

    $("#sortablemobile").on("click", ".updateIndex", function () {
      const index = $(this).data("index");
      const value = $(this).data("value");
      const data = JSON.parse($("#topPrioritiesButtonInput").length ? $("#topPrioritiesButtonInput").val() : $("#savingsGoalsButtonInput").val());
      if (data[index] != null) $(`#sortable-main .remove-button:eq(${index})`).trigger("click");
      data[index] = value;
      updateMobileFields(data);
    });
    $(window).resize(function () {
      const data = JSON.parse($("#topPrioritiesButtonInput").length ? $("#topPrioritiesButtonInput").val() : $("#savingsGoalsButtonInput").val());
      updateMobileFields(data);
    });
  });

  $("head").append(
    $("<style>")
      .attr("type", "text/css")
      .text(`.dropdown-transform { transform: translate3d(0px, ${$(".arrowIcon").parent().outerHeight()}px, 0px) !important; }`)
  );

  function removeAllInWeb() {
    $("#sortable")
      .find(".remove-button")
      .toArray()
      .map(function (value) {
        $(value).click();
      });
  }

  function reset() {
    updateMobileFields($("#topPrioritiesButtonInput").length ? [null, null, null, null, null, null, null, null] : [null, null, null, null]);
    removeAllInWeb();
  }

  // Priority To Discuss Page JS
  document.addEventListener("DOMContentLoaded", function () {
    $("#refresh").on("click", reset);

    // // Ensure the first accordion item is always open
    // const firstAccordionItem = document.querySelector(".accordion-item:first-of-type");
    // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    // if (firstAccordionItem) {
    //   const firstCollapse = firstAccordionItem.querySelector(".accordion-collapse");
    //   firstCollapse.classList.add("show");
    // }

    // // Sent checkbox value to controller
    // var checkboxValues = {};

    // // First set all to true
    // $('input[type="checkbox"]').each(function () {
    //   var checkboxId = $(this).attr("id");
    //   checkboxValues[checkboxId] = true;
    //   $(this).prop("checked", true); // Check the checkboxes initially
    // });

    // // Update checkboxValues object when any checkbox is changed
    // $('input[type="checkbox"]').on("change", function () {
    //   var checkboxId = $(this).attr("id");
    //   var isChecked = $(this).prop("checked");
    //   checkboxValues[checkboxId] = isChecked;

    //   if (checkboxId.includes("discuss")) {
    //     checkboxId = checkboxId.replace("_discuss", "");
    //     if (!isChecked) {
    //       $("[data-identifier=" + checkboxId + "]")
    //         .siblings("img")
    //         .hide();

    //       return true;
    //     } else {
    //       $("[data-identifier=" + checkboxId + "]")
    //         .siblings("img")
    //         .show();
    //     }
    //   }
    // });

    // $("#priorityNext").on("click", function (event) {
    //   $.ajax({
    //     type: "POST",
    //     url: "{{ route('priorities.redirect') }}",
    //     data: checkboxValues,
    //     headers: {
    //       "X-CSRF-TOKEN": csrfToken
    //     },
    //     success: function (response) {
    //       // Handle success, if needed
    //     },
    //     error: function (xhr, status, error) {
    //       // Handle error, if needed
    //     }
    //   });
    // });
  });
}