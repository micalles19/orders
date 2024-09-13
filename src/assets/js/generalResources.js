const getURLParam = (parameterName) => {
  parameterName = parameterName.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

  let regex = new RegExp("[\\?&]" + parameterName + "=([^&#]*)"),
    result = regex.exec(location.search);

  return result === null
    ? ""
    : decodeURIComponent(result[1].replace(/\+/g, " "));
};

export { getURLParam };
