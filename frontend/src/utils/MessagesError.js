const messages = {
  default: "Ocorreu um erro. Por favor, tente novamente mais tarde",
  LoginInvalidException: "E-mail ou senha incorretos",
  EmailAlreadyExistExeception: "Este e-mail já está cadastrado",
  ErrorValidationException:
    "Dados fornecidos são inválidos. Verifique-os novamente",
  CredentialsInvalidResetTokenException:
    "Credenciais inválidas para redefinição de senha. Token já usado ou verifique o email fornecido",
  TokenResetPasswordInvalidException: "Token inválido",
  UserNotExistsException: "",
};

const getMessage = (key = "default") => {
  return messages[key] ?? messages.error;
};

export default {
  getMessage,
};
