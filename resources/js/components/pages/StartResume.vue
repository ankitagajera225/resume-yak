<template>
  <div class="text-center">
    <form action @submit.prevent="submit">
      <div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" v-model="terms_check" />

          <label
            class="custom-control-label pointer"
            :class="{ 'text-danger' : !submitStatus === 'ERROR' }"
            for="termsCheckbox"
            @click="changeTerms()"
          ></label>
          <img
            :src="url+'/images/bg/yak-head.png'"
            alt
            class="yak-head-img"
            v-tooltip="tooltip"
          />
          I have read and
          agree to Resume Yak’s
          <a href style="color: #fb643e">
            Term’s
            of Use
          </a>
          &
          <a href style="color: #fb643e">Privacy Policy</a>
          <p
            v-if="submitStatus === 'ERROR'"
            class="alert alert-warning"
            style="margin-bottom: -15px;font-size: 14px;"
          >You need to accept our Terms of Use and Privacy Policy</p>
        </div>
      </div>

      <button
        class="btn1 btn-rounded btn-next mt-4"
        type="submit"
        v-if="submitStatus !== 'ERROR'"
      >
        <span class>Next</span>
        <span class="pl-5">
          <i class="next-icon fas fa-chevron-right"></i>
        </span>
      </button>

      <button
        class="btn1 btn-rounded btn-next mt-4"
        type="submit"
        v-else-if="submitStatus !== 'OK'"
        disabled
      >
        <span class>Next</span>
        <span class="pl-5">
          <i class="next-icon fas fa-chevron-right"></i>
        </span>
      </button>
    </form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import JQuery from 'jquery';
let $ = JQuery;
export default {
  props: {
    url: {
      type: String,
      required: true
    },
      tooltip:{
          type: String,
          required: true
      }
  },

  data() {
    return {
      terms_check: false,
      submitStatus: ""
    };
  },

  validations: {
    terms_check: {
      required
    }
  },

  methods: {
    changeTerms() {
      console.log("chages");
      this.terms_check = !this.terms_check;

      if (this.terms_check) {
        this.submitStatus = "OK";
      } else {
        this.submitStatus = "ERROR";
      }
    },

    submit() {
      $(".custom-checkbox").removeClass("animated shake");

      if (!this.terms_check) {
        this.submitStatus = "ERROR";
        $(".custom-checkbox").addClass("animated shake");
      } else {
        this.submitStatus = "OK";
        // Insert into the database...

        var querystring = require('querystring');
        window.axios.post('acc_tnc').then(({data}) => {
          if (data.status == 1) {
            // For design redirect to contact info page
            window.location = this.url + "/contact/#/new";
          } else {

          }
        });

      }
    }
  }
};
</script>
