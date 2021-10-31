function range_change_event() {
  var percent = slider.value;
  var meter_value = semi_cf - (percent * semi_cf) / 100;
  mask.setAttribute("stroke-dasharray", meter_value + "," + cf);
  meter_needle.style.transform =
    "rotate(" + (270 + (percent * 180) / 100) + "deg)";
  lbl.textContent = percent + "%";
}

async function setUpCustomSlider(container) {
  /* Set radius for all circles */
  var r = 250;
  var circles = container.querySelectorAll(".circle");
  var total_circles = circles.length;
  for (var i = 0; i < total_circles; i++) {
    circles[i].setAttribute("r", r);
  }

  /* Set meter's wrapper dimension */
  var meter_dimension = r * 2 + 100;
  var wrapper = document.querySelector("#wrapper");
  wrapper.style.width = meter_dimension + "";
  wrapper.style.height = meter_dimension + "";

  /* Add strokes to circles  */
  var cf = 2 * Math.PI * r;
  var semi_cf = cf / 2;
  var semi_cf_1by3 = semi_cf / 3;
  var semi_cf_2by3 = semi_cf_1by3 * 2;
  container
    .querySelector("#outline_curves")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);
  container
    .querySelector("#low")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);
  container
    .querySelector("#avg")
    .setAttribute("stroke-dasharray", semi_cf_2by3 + "," + cf);
  container
    .querySelector("#high")
    .setAttribute("stroke-dasharray", semi_cf_1by3 + "," + cf);
  container
    .querySelector("#outline_ends")
    .setAttribute("stroke-dasharray", 2 + "," + (semi_cf - 2));
  container
    .querySelector("#mask")
    .setAttribute("stroke-dasharray", semi_cf + "," + cf);

  /* Bind range slider event*/
  var slider = container.querySelector(".slider");
  var lbl = container.querySelector(".lbl");
  var mask = container.querySelector(".mask");
  var meter_needle = container.querySelector(".meter_needle");
  slider.addEventListener("input", range_change_event);
}

class WidgetHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        customSliderContainer: ".custom-slider-container",
      },
    };
  }
  getDefaultElements() {
    const selectors = this.getSettings("selectors");
    return {
      $customSliderContainer: this.$element.find(
        selectors.customSliderContainer
      ),
    };
  }
  bindEvents() {
    setUpCustomSlider(this.elements.$customSliderContainer);
  }
}

jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(WidgetHandlerClass, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction(
    "frontend/element_ready/customslider.default",
    addHandler
  );
});
