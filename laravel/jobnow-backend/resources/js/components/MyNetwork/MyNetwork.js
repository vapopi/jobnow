import React from 'react'

const MyNetwork = () => {
  return (
    <div>MyNetwork</div>
  )
}

export default MyNetwork;

if (document.getElementById('myNetwork')) {
    ReactDOM.render(<MyNetwork />, document.getElementById('myNetwork'));
}