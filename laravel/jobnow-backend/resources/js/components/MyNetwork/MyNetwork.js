import React from 'react'
import ReactDOM from 'react-dom';

const MyNetwork = () => {
  return (
    <div>MyNetwork</div>
  )
}

export default MyNetwork;

if (document.getElementById('myNetwork')) {
    ReactDOM.render(<MyNetwork />, document.getElementById('myNetwork'));
}