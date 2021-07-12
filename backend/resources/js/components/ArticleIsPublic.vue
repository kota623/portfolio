<template>
  <div class="radioTile radioTile--public">
    <div class="radioTile__group">
      <div class="radioTile__inputWrap">
        <input
          id="public_n"
          type="radio"
          name="public"
          value="false"
          class="radioTile__input validate[required]"
          :checked="pub(false)"
        />
        <label for="public_n" class="radioTile__button">
          <span class="radioTile__value">非公開</span>
        </label>
      </div>
      <div class="radioTile__inputWrap">
        <input
          id="public_y"
          type="radio"
          name="public"
          value="true"
          class="radioTile__input validate[required]"
          :checked="pub(true)"
        />
        <label for="public_y" class="radioTile__button">
          <span class="radioTile__value">公開</span>
        </label>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    public: {
      type: Boolean,
      required: true,
      default: false,
    },
  },
  data() {
    return {};
  },
  methods: {
    //checkedを未登録の時はfalse、一致するものがある時はそちらを返す
    pub(value) {
      if (Boolean(value) == Boolean(this.public)) {
        return true;
      }
    },
  },
};
</script>
<style lang="css" scoped>
/* reset
--------------------------------*/
input[type='radio'] {
  display: none;
}

/* Radio TIle
--------------------------------*/
.radioTile {
  width: 20%;
}

.radioTile__lead {
  color: #666;
  font-size: 0.85em;
  text-align: center;
  margin-bottom: 0em;
  color: #6ee7b7;
}

.radioTile__group {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: center;
  /*width: 100%;*/
  /*height: 100%;*/
  width: 12rem;
}
@media screen and (max-width: 255px) {
  .radioTile__group {
    width: 6rem;
    margin: 0 auto;
  }
  .radioTile {
    width: 100%;
  }
  .radioTile__inputWrap {
    margin-bottom: 1rem;
  }
}

.radioTile__inputWrap {
  flex-basis: 42%;
  white-space: nowrap;
}

.radioTile__input {
  height: 100%;
  width: 100%;
  margin: 0;
  cursor: pointer;
}

.radioTile__button {
  display: flex !important;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 5rem;
  height: 1rem;

  border: 2px solid #6ee7b7;
  border-radius: 5px;
  padding: 1rem;
  position: relative;
  border-radius: 3px;
  cursor: pointer;
}
.radioTile__button .radioTile__value {
  color: #6ee7b7;
}

.radioTile__input:checked + .radioTile__button {
  background-color: #6ee7b7;
  border: 2px solid #6ee7b7;
  color: #fff;
  transform: scale(1.1);
}
.radioTile__input:checked + .radioTile__button .fa {
  color: #fff;
}
.radioTile__input:checked + .radioTile__button .radioTile__value {
  color: #fff;
}

.radioTile--public .radioTile__inputWrap {
  height: 2rem;
}

@keyframes gelatine {
  0% {
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
  25% {
    -webkit-transform: scale(0.9, 1.1);
    transform: scale(0.9, 1.1);
  }
  50% {
    -webkit-transform: scale(1.1, 0.9);
    transform: scale(1.1, 0.9);
  }
  75% {
    -webkit-transform: scale(0.95, 1.05);
    transform: scale(0.95, 1.05);
  }
  100% {
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
  }
}
</style>
