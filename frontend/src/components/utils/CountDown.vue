<template>
  <div class="d-flex align-items-end gap-1 align-items-end responsive-font">
    <div class="me-2">
      <i class="bi bi-stopwatch fs-5"></i>
    </div>
    <div v-if="dias > 0">
      <span>{{ dias }}D</span>
      <span>:</span>
    </div>
    <div>
      <span>{{ horas }}</span>
    </div>
    <span>:</span>
    <div>
      <span>{{ minutos }}</span>
    </div>
    <span>:</span>
    <div>
      <span>{{ segundos }}</span>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dias: 0,
      horas: '00',
      minutos: '00',
      segundos: '00'
    }
  },
  methods: {
    timer(DefHoras) {
      setInterval(() => {
        let agora = new Date();
        let horas = agora.getHours();
        let minutos = agora.getMinutes();
        let segundos = agora.getSeconds();

        const totalSegundosReset = DefHoras * (60 * 60);
        let totalSegundosHoje = horas * 3600 + minutos * 60 + segundos; // Total de segundos desde a meia-noite
        let totalSegundosRestantes = totalSegundosReset - totalSegundosHoje; // 12 horas em segundos

        if (totalSegundosRestantes <= 0) {
          totalSegundosRestantes += totalSegundosReset; // Reinicia após 12 horas
        }

        let diasRestantes = Math.floor(totalSegundosRestantes / (60 * 60 * 24));
        let horasRestantes = Math.floor((totalSegundosRestantes % 86400) / (60 * 60));
        let minutosRestantes = Math.floor((totalSegundosRestantes % 3600) / 60);
        let segundosRestantes = totalSegundosRestantes % 60;

        this.dias = diasRestantes;
        this.horas = horasRestantes < 10 ? '0' + horasRestantes : horasRestantes.toString();
        this.minutos = minutosRestantes < 10 ? '0' + minutosRestantes : minutosRestantes.toString();
        this.segundos = segundosRestantes < 10 ? '0' + segundosRestantes : segundosRestantes.toString();

      }, 1000);
    }
  },
  mounted() {
    this.timer(12);
  },
}
</script>
<style lang="scss" scoped>
.responsive-font {
  font-size: calc(15px + 1vw);
  font-family: 'Aclonica', sans-serif;
  /* Defina o tamanho da fonte em vw */
}
</style>