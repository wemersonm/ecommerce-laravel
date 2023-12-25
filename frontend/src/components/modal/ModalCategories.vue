<template>
  <div class="body bg-light position-absolute w-100">
    <ul class="nav flex-column">
      <li class="nav-item text-center small mb-1" v-for="i in 15" :key="i">
        <a href="#"
          class="nav-link p-0 text-secondary link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fw-bold-hover">Lorem
          ipsum dolor sit amet consectetur {{ i }}</a>
      </li>
    </ul>
  </div>
</template>

<script>

export default {
  data() {
    return {
      categories: {
        'hardware': [
          'Coolers',
          'Disco Rígido(HD)',
          'Drives',
          'Fontes',
          'Kit Hardware',
          'Memória RAM',
          'Placa de vídeo(VGA)',
          'Placas Interfaces',
          'Placas - mãe',
          'Processadores',
          'SSD',
        ],
        'Perifericos': [
          'Cabos e Adaptadores',
          'Caixa de Som',
          'Carteira de Criptomoedas',
          'Fone de Ouvido Gamer',
          'Gabinetes',
          'Headset Gamer',
          'Headsets',
          'Kit Gamer',
          'Mesa Digitalizadora',
          'Mouse Gamer',
          'Mouse Pad',
          'Óculos',
          'Pen Drive',
          'Streamer',
          'Suportes',
          'Suprimentos',
          'Teclado e Mouse',
          'Teclado Gamer',
          'Webcam e Videoconferência',
        ],
        'Computadores': [
          'Impressoras',
          'Monitores',
          'Notebooks',
          'PC',
          'Scanners',
          'Softwares',
        ]
      }
    }
  },
  methods: {
  },
}
</script>

<style lang="scss" scoped>

</style>