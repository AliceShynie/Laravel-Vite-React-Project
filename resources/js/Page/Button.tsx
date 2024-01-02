import React, { useState } from "react";

interface Props {
    children: string;
    color?: "primary" | "secondary" | "danger";
    onClick: () => void;
}
const Button = ({ color = "primary", children, onClick }: Props) => {
    
    const [showMessage, setShowMessage] = useState(false);

    const handleClick = () => {
        onClick(); // Execute the provided onClick function

        // Display the message for a short duration
        setShowMessage(true);
        setTimeout(() => {
            setShowMessage(false);
        }, 2000); // Adjust the duration as needed
    };
    return (
        <>
        <button className={"btn btn-" + color} onClick={handleClick}>
            {children}
        </button>
        {showMessage && <div>Message displayed and dismissed!</div>}
        </>
    );
};

export default Button;
