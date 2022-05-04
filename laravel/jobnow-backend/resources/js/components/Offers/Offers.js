import React from 'react'
import ReactDOM from 'react-dom';

const Offers = () => {
  return (
    <p>Offers</p>
  )
}

export default Offers;

if (document.getElementById('offers')) {
    ReactDOM.render(<Offers />, document.getElementById('offers'));
}