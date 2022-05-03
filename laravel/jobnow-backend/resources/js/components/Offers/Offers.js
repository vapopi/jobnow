import React from 'react'

const Offers = () => {
  return (
    <div>Offers</div>
  )
}

export default Offers;

if (document.getElementById('offers')) {
    ReactDOM.render(<Offers />, document.getElementById('offers'));
}