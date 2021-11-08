// This function applies the fill to our sliders by using a linear gradient background
function applyFill(slider) {
  // Let's turn our value into a percentage to figure out how far it is in between the min and max of our input
  const settings = {
    fill: "red",
    background: "#d7dcdf",
  };
  const percentage =
    (100 * (slider.value - slider.min)) / (slider.max - slider.min);
  // now we'll create a linear gradient that separates at the above point
  // Our background color will change here
  const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${
    settings.background
  } ${percentage + 0.1}%)`;
  slider.style.background = bg;
}
function round(num, fixed) {
  var re = new RegExp("^-?\\d+(?:.\\d{0," + (fixed || -1) + "})?");
  return num.toString().match(re)[0];
}
async function setUpCustomSlider(cont) {
  const container =
    cont && cont.length >= 1 && document.querySelector(`#${cont[0].id}`);
  //console.log("here", window.last, `last_${cont[0].id}`);
  if (container) {
    const section = container.closest("section");
    console.log(window.last, !window.last);
    if (!window.last) window.last = 0;

    if (section) {
      section.classList.add(
        "elementor-section-full_width",
        "elementor-section-stretched",
        "elementor-section-height-default",
        "elementor-section-height-default"
      );
      section.setAttribute(
        "data-settings",
        "{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
      );
      section.classList.remove("elementor-section-boxed");
      section.style.position = "static";
      section.firstElementChild.style.position = "absolute";
      section.firstElementChild.style.left = 0;
      section.firstElementChild.style.zIndex = 2;
      const placeHolder = document.createElement("div");
      placeHolder.style.height = "600px";
      placeHolder.className = "placeholder-height";
      section.appendChild(placeHolder);
    }
    const wrapper = container.parentElement;
    const bgColor = wrapper.querySelector(".cs-bg");
    const meter = container.querySelector(".meter");
    const white = container.querySelector(".white");
    const chamber = container.querySelectorAll(".chamber");
    const gradient = container.querySelector(".gradient");
    var black = container.getElementsByClassName("black")[0];
    var tick = container.getElementsByClassName("tick")[0];
    gradient.style.height = "17vw";
    gradient.style.width = "17vw";
    white.style.height = "9vw";
    white.style.width = "9vw";
    tick.style.width = "9vw";
    let animationInterval = 0;
    let stylePrint = false;
    chamber.forEach((e, idx) => {
      if (idx == 0) e.classList.add("active");
      e.style.background = `linear-gradient(to right, ${bgColor.innerHTML} 50%, ${bgColor.innerHTML} 50%)`;

      if (!stylePrint) {
        const styling = `#${cont[0].id} .chamber { 
      transform: translate(-50%, -50%)rotateZ(calc(var(--i)*-${
        180 / chamber.length
      }deg));
    }
      `;
        const style = document.createElement("style");
        style.innerHTML = styling;
        document.body.appendChild(style);
        stylePrint = true;
      }
    });

    white.style.backgroundColor = bgColor.innerHTML;
    meter.style.backgroundColor = bgColor.innerHTML;
    const nSteps = chamber.length;

    var m = wrapper.querySelector(".cs-range-slider .m");
    const steps = round(100 / nSteps, 4);
    const stepsNumbers = Array.from(chamber).map((e, idx) =>
      round(Number(steps * idx), 4)
    );
    m.setAttribute("step", `${steps}`);
    var mValue = wrapper.querySelector(".cs-range-slider span");
    //let previous = m.value;
    // let currentActiveChamber = container.querySelector(".chamber.active");
    //let currentStep = 1;
    mValue.innerHTML = 0;
    const texts = wrapper.querySelectorAll(".text-item");
    const images = wrapper.querySelectorAll(".text-item img");
    console.log("before", window.last);
    m.addEventListener("input", function () {
      black.style.transform = tick.style.transform =
        "translate(-50%,-50%)scaleX(-1)rotateZ(-" +
        (180 / 100) * m.value +
        "deg)";
      console.log(window.last);
      let currentStep =
        mValue.innerHTML == nSteps - 1
          ? nSteps
          : stepsNumbers.indexOf(
              stepsNumbers.find(
                (e) => round(Number(e), 2) == round(Number(m.value), 2)
              )
            );

      mValue.innerHTML = currentStep;
      window.last = currentStep;

      //console.log(stepsNumbers, round(Number(m.value), 2));

      texts.forEach((e) => {
        e.style.display = "none";
        e.style.opacity = 1;
      });

      if (currentStep) {
        animationInterval && clearInterval(animationInterval);
        texts[currentStep - 1].style.display = "block";
        texts[currentStep - 1].style.opacity = 1;

        if (wrapper.querySelector(".copy"))
          wrapper.removeChild(wrapper.querySelector(".copy"));

        const img = images[currentStep - 1];
        const div = document.createElement("div");
        div.classList.add("copy");
        wrapper.insertBefore(div, wrapper.firstElementChild);

        if (img.className.includes("Child"))
          div.classList.add(
            ...img.className
              .replaceAll("Child", "Parent")
              .split(" ")
              .filter((e) => e)
          );
        console.log(document.body.classList);

        div.innerHTML = `
        <img src="${img.src}"
        class="elementor-repeater-item-${currentStep - 1} animated ${
          img.className
        }"
        alt="${img.alt}" 
        style="
        top:${img.style.top};left:${img.style.left};
         width: ${img.style.width}; 
       max-width: ${img.style.maxWidth};
       min-width: ${img.style.minWidth};
       opacity: ${img.style.opacity};
        "
        />
        `;
        //console.log(Number(img.nextElementSibling?.innerHTML || 0) * 1000);
        if (img.classList.contains("repeat-yes")) {
          div.innerHTML = `
        <img src="${img.src}"
        class="elementor-repeater-item-${currentStep - 1} animated ${
            img.className
          }"
        alt="${img.alt}" 
       style="top:${img.style.top};left:${img.style.left} ; 
       width: ${img.style.width}; 
       max-width: ${img.style.maxWidth};
       min-width: ${img.style.minWidth};
         opacity: ${img.style.opacity};
       animation-iteration-count: infinite !important;
       animation-duration: ${
         img.nextElementSibling?.innerHTML || 0 || 4
       }s !important;
       "
        />

        `;
          if (img.className.includes("Child")) {
            div.style.cssText = `
            animation-iteration-count: infinite !important;
       animation-duration: ${
         img.nextElementSibling?.innerHTML || 0 || 4
       }s !important;
            `;
          }
        }
      }
      gradient.style.transform =
        "translate(-50%,-50%)rotateZ(" + (180 / 100) * m.value + "deg)";

      // 2. apply our fill to the input
      applyFill(m);
    });

    m.value = m.step * window.last;

    var event = new Event("input", {
      bubbles: true,
      cancelable: true,
    });

    m.dispatchEvent(event);

    black.style.transform = tick.style.transform =
      "translate(-50%,-50%)scaleX(-1)rotateZ(-" +
      (180 / 100) * m.value +
      "deg)";
    texts.forEach((e) => {
      const eHeight = e.style.height;
      const pHeight = e.parentElement.style.height;
      //console.log(e, eHeight, pHeight);
      e.parentElement.style.height = !pHeight
        ? eHeight
        : (pHeight < eHeight && eHeight) || pHeight;
    });
    applyFill(m);
  }
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
