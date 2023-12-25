import {
  defineRule,
  Form,
  Field,
  ErrorMessage,
  useForm,
  configure,
  useIsFieldValid,
} from "vee-validate";
import { required, email, min, max, confirmed } from "@vee-validate/rules";

defineRule("required", required);
defineRule("email", email, { validateOnInput: true });
defineRule("min", min);
defineRule("max", max);
defineRule("confirmed", confirmed);

configure({
  generateMessage: (context) => {
    const messages = {
      required: "O campo é obrigatório",
      email: "O email não e válido",
      min: `O campo deve conter no mínimo ${context.rule.params} caracteres`,
      max: `O campo deve conter no maxímo ${context.rule.params} caracteres`,
      confirmed: "Certifique-se de que as senhas informadas são idênticas",
    };

    const message = messages[context.rule.name];
    return message ?? "O campo não e válido";
  },
  validateOnModelUpdate: true,
});

export default {
  required,
  email,
  min,
  max,
  confirmed,
  Form,
  Field,
  ErrorMessage,
  useForm,
  configure,
  useIsFieldValid,
};
