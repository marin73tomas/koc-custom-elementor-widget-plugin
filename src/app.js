import React from "react";
import ReactDOM from "react-dom";
import Speedometer from "./components/Speedometer";

export default async function app(cont) {
  const container =
    cont && cont.length >= 1 && document.querySelector(`#${cont[0].id}`);

  if (container) {
    const wrapper = container.parentElement;
    const items = wrapper.querySelector(".items");

    //get all variables printed on widget.php inside the div with class hidden-variables
    const rightLabel = wrapper.querySelector(".label-right")?.innerHTML || 0;
    const leftLabel = wrapper.querySelector(".label-left")?.innerHTML || 0;
    const gapSize = Number(wrapper.querySelector(".gap-size")?.innerHTML || 0);
    const textAlign = wrapper.querySelector(".text-align")?.innerHTML || 0;
    const gapColor = items.getAttribute("data-gap-color") || 0;
    const unfilledSegmentColor =
      wrapper.querySelector(".unfilled-segment-color")?.innerHTML || "black";
    wrapper.querySelector(".text-align")?.innerHTML;
    const needleSize =
      Number(
        wrapper.querySelector(".needle-size")?.innerHTML.replaceAll(" ", "")
      ) || 0;

    const ringSize =
      wrapper
        .querySelector(".speedoinnersize")
        ?.innerHTML.replaceAll(" ", "") || 0;
    const show = wrapper
      .querySelector(".show_speedometer")
      .innerHTML.includes("yes");
    const showMarks = wrapper
      .querySelector(".show_step_marks")
      .innerHTML.includes("yes");

    //empty object use for setting the styling of the segments dynamically
    const emptyObject = {};
    emptyObject[
      `& .arc path:nth-child(odd):nth-child(n+${
        (window.kocCurrentStep || 0) * 2
      })`
    ] = {
      fill: `${unfilledSegmentColor} !important`,
    };
    const initialSegmentStyle = emptyObject;

    //create an object with all items properties so it can be reused across the speedometer re-renders
    const allItems = Array.from(items.querySelectorAll(".item")).map(
      (item, idx) => ({
        text: item.querySelector(".text")?.innerHTML || "",
        className: item.className,
        //data color contains the color of the widget
        dataColor: item.getAttribute("data-color"),
        medias: Array.from(item.querySelectorAll(".medias .media")).map(
          (media) => ({
            //animated class is used to the animation given by elementor settings
            className: `media animated ${[...media.classList].join(" ")}`,
            src: media.innerHTML,
            style: JSON.parse(media.getAttribute("data-styles")),
          })
        ),
      })
    );

    ReactDOM.render(
      <Speedometer
        items={allItems}
        variables={{
          show,
          showMarks,
          rightLabel,
          leftLabel,
          gapSize,
          textAlign,
          gapColor,
          needleSize,
          ringSize,
          unfilledSegmentColor,
          initialSegmentStyle,
        }}
        //these two window props below are set in the onchange listener of the slider component 
        lastStep={window.kocCurrentStep}
        lastValue={window.kocCurrentValue}
      />,
      container
    );
  }
}
