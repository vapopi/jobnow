import React from 'react'

const Tickets = () => {
  return (
    <div>Tickets</div>
  )
}

export default Tickets;

if (document.getElementById('tickets')) {
    ReactDOM.render(<Tickets />, document.getElementById('tickets'));
}