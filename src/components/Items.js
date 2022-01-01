import React from "react";
import Box from "@mui/material/Box";
const Items = ({ items, currentStep, textAlign }) =>
  items.map((item, idx) => (
    <Box
      style={{
        display: `${currentStep == idx + 1 ? "block" : "none"}`,
      }}
      className={`${item.className}`}
    >
      <div className="text" style={{ textAlign: textAlign }}>
        <p dangerouslySetInnerHTML={{ __html: item.text }} />
      </div>
      <div className="medias">
        {
          //hide img if it's an elementor placeholder
          item.medias
            .filter(
              (media) =>
                !media.src.includes("/elementor/assets/images/placeholder.png")
            )
            .map((media) => (
              <img
                className={media.className}
                src={media.src}
                alt=""
                style={media.style}
              />
            ))
        }
      </div>
    </Box>
  ));
export default Items;
