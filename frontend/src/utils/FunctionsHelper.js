const toBRL = (number) => {
  return number.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
};

export default {
  toBRL,
};
