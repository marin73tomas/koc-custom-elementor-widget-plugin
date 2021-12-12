import React, { useState, useMemo, useEffect } from "react";
import ReactSpeedometer from "react-d3-speedometer";
import Box from "@mui/material/Box";
import Slider from "@mui/material/Slider";

const Speedometer = ({ items, variables }) => {
  const [currentValue, setCurrentValue] = useState(0);
  const [currentStep, setCurrentStep] = useState(0);
  const [segmentStyles, setSegmentStyles] = useState({
    "& .arc path:nth-child(odd)": {
      fill: "black !important",
    },
  });
  const {
    rightLabel,
    leftLabel,
    gapSize,
    textAlign,
    gapColor,
    needleSize,
    ringSize,
  } = variables;

  const maxValue = 180;
  const length = items ? items.length : 0;
  const step = (180 - gapSize * (length - 1)) / length;

  const customProps = useMemo(() => {
    let stepCounter = 1;
    let gapCounter = 1;
    let data = 0;
    const stops = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx) {
        if (idx == 1) {
          return step;
        }

        data = step * stepCounter + gapSize * gapCounter;

        if (idx % 2 != 0) gapCounter++;
        if (idx % 2 == 0) stepCounter++;
        return data;
      }
      return idx;
    });
    let counter = 0;
    const colors = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx % 2 == 0) {
        const color = items[counter].dataColor;
        counter++;
        return color;
      }
      return gapColor;
    });

    return { stops, colors };
  }, []);
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
        <div className="text" style={{ textAlign: textAlign }}>
          {item.text}
        </div>
        <div className="medias">
          {item.medias
            .filter(
              (media) =>
                !media.src.includes("/elementor/assets/images/placeholder.png")
            )
            .map((media) => (
              <img
                className="media"
                src={media.src}
                alt={media.alt}
                style={media.style}
              />
            ))}
        </div>
      </Box>
    ));

  return (
    <Box sx={segmentStyles}>
      <Items className="items" />
      <div className="slider-inner-container">
        <ReactSpeedometer
          fluidWidth={true}
          className="speedometer"
          value={currentValue}
          customSegmentStops={stops}
          segmentColors={colors}
          minValue={0}
          needleHeightRatio={needleSize}
          ringWidth={ringSize}
          maxValue={maxValue}
          labelFontSize={0}
          valueTextFontSize={0}
        />
      </div>
      <Box className="slider-track-container">
        <p className="label-slider label-right">{rightLabel}</p>
        <p className="label-slider label-left">{leftLabel}</p>
        <Slider
          className="slider"
          aria-label="slider-koc"
          defaultValue={currentValue}
          step={180 / length}
          onChange={onChange}
          min={0}
          max={maxValue}
        />
      </Box>
    </Box>
  );
};

export default Speedometer;
