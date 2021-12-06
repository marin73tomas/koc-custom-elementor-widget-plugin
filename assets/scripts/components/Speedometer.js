import React, { useState, useMemo, useEffect } from "react";
import ReactSpeedometer from "react-d3-speedometer";
import Box from "@mui/material/Box";
import Slider from "@mui/material/Slider";

const Speedometer = ({
  items,
  gapSize = 5,
  gapColor = "white",
  width,
  height,
  dimensionUnit,
  needleSize = 0.5,
}) => {
  const [currentValue, setCurrentValue] = useState(0);
  const [currentStep, setCurrentStep] = useState(0);
  const [segmentStyles, setSegmentStyles] = useState({
    "& .arc path:nth-child(odd)": {
      fill: "black !important",
    },
  });

  const maxValue = 180;
  const length = items ? items.length : 0;
  const step = 180 / length;
  const customProps = useMemo(() => {
    let counter = 1;
    let data = 0;
    const stops = [
      0,
      ...new Array(length * 2 - 2).fill(0).map((e, idx) => {
        if (idx % 2 == 0) {
          data = step * counter - gapSize;
          counter++;
          return data;
        }
        return data + gapSize;
      }),
      180,
    ];
    counter = 0;
    const colors = new Array(length * 2 - 1).fill(0).map((e, idx) => {
      if (idx % 2 == 0) {
        const color = items[counter].getAttribute("data-color");
        counter++;
        return color;
      }
      return gapColor;
    });

    return { stops, colors };
  }, [step, gapSize]);
  const { stops, colors } = customProps;

  const onChange = (event) => {
    const value = event.target.value;

    const currentStep = parseInt((value * length) / maxValue);

    const setValue = value == 0 || value == maxValue ? value : value - gapSize;
    const emptyObject = {};
    emptyObject[`& .arc path:nth-child(odd):nth-child(n+${currentStep * 2})`] =
      {
        fill: "black !important",
      };
    setSegmentStyles(emptyObject);
    setCurrentValue(setValue);
    setCurrentStep(currentStep);
  };

  const Items = () =>
    items.map((item, idx) => (
      <Box
        style={{
          display: `${currentStep == idx + 1 ? "block" : "none"}`,
        }}
        className={`${item.className}`}
      >
        <div className="text">
          {item.querySelector(".text")?.innerHTML || ""}
        </div>
        <div className="medias">
          {Array.from(item.querySelectorAll(".medias .media")).map((media) => (
            <img
              className="media"
              src={media.innerHTML}
              alt={[...media.classList].join("")}
            />
          ))}
        </div>
      </Box>
    ));

  return (
    <Box sx={segmentStyles}>
      <Items className="items" />
      <ReactSpeedometer
        className="speedometer"
        value={currentValue}
        customSegmentStops={stops}
        segmentColors={colors}
        minValue={0}
        maxValue={maxValue}
        segments={length * 2 - 2} //steps + nGaps
        labelFontSize={0}
        valueTextFontSize={0}
        needleHeightRatio={needleSize}
      />
      <Slider
        className="slider"
        aria-label="slider-koc"
        defaultValue={currentValue}
        step={step}
        onChange={onChange}
        min={0}
        max={maxValue}
      />
    </Box>
  );
};

export default Speedometer;
