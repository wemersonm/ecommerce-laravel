import {
  defineRule,
  Form,
  Field,
  ErrorMessage,
  useForm,
  configure,
  useIsFieldValid,
} from "vee-validate";
import {
  required,
  email,
  min,
  max,
  confirmed,
  one_of,
  not_one_of,
} from "@vee-validate/rules";

defineRule("required", required);
defineRule("email", email);
defineRule("min", min);
defineRule("max", max);
defineRule("confirmed", confirmed);
defineRule("one_of", one_of);
defineRule("not_one_of", not_one_of);

configure({
  generateMessage: (context) => {
    const messages = {
      required: "O campo é obrigatório",
      email: "O email não e válido",
      min: `O campo deve conter no mínimo ${context.rule.params} caracteres`,
      max: `O campo deve conter no maxímo ${context.rule.params} caracteres`,
      confirmed: "Certifique-se de que as senhas informadas são idênticas",
      one_of: "O campo e inválido",
      not_one_of: "O campo e inválido",
    };

    const message = messages[context.rule.name];
    return message ?? "O campo não e válido";
  },
  validateOnChange: true,
});

export default {
  required,
  email,
  min,
  max,
  confirmed,
  one_of,
  not_one_of,
  Form,
  Field,
  ErrorMessage,
  useForm,
  configure,
  useIsFieldValid,
};
