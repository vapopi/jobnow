import React from 'react'
import ReactDOM from 'react-dom';

const Tickets = () => {
  return (
    <div>Tickets</div>
  )
}

export default Tickets;

if (document.getElementById('tickets')) {
    ReactDOM.render(<Tickets />, document.getElementById('tickets'));
}