const messages = {
  default: "Ocorreu um erro. Por favor, tente novamente mais tarde",
  LoginInvalidException: "E-mail ou senha incorretos",
  EmailAlreadyExistExeception: "Este e-mail já está cadastrado",
};

const getMessageError = (key = "default") => {
  return messages[key] ?? messages.error;
};

export default {
  getMessageError,
};
