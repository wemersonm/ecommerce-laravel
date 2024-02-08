const toBRL = (number) => {
  return number.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
};

// outras funcções

export default {
  toBRL,
};
