import "./bootstrap";
import React from "react";
import ListGroup from "./Page/ListGroup";
import Blog from "./Page/Blog";
import Button from "./Page/Button";
import Alert from "./Page/Alert";
import ReactDOM from "react-dom";

// const App = () => {
//     let items = ["New York", "San Francisco", "Tokyo", "London", "Paris"];
//     return (
//         <div>
//             <Blog />
//         </div>
//     );
// };

const App = () => {
    return (
        <div className="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <Button data-bs-dismiss="alert" aria-label="Close" color="danger" children="My Button HEHEHE" onClick={() => console.log("Clicked")} />
        </div>
    );
};

ReactDOM.render(<App />, document.getElementById("app"));
