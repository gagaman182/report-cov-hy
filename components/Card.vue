<template>
  <div class="column">
    <div class="card">
      <header class="card-header">
        <b-icon :icon="icon" size="is-large" type="is-primary" />
        <p class="title is-4 has-text-grey mt-2 ml-2">
          {{ title }}
        </p>
      </header>
      <div class="card-content">
        <b-message type="is-success" has-icon>
          <p class="mt-2 subtitle is-4">
            เซิฟเวอร์จะประมวลผลข้อมูลอัตโนมัติ ในช่วงเวลา 8.08 น. ของทุกวัน
          </p>
        </b-message>
        <!-- <div class="content has-text-centered">
          <b-icon :icon="icon" size="is-large" type="is-primary" />
        </div> -->
        <b-tabs v-model="activeTab" size="is-medium" class="block">
          <b-tab-item label="ข้อมูลจากโรงพยาบาล (PMK)">
            <b-table
              :loading="isLoading_pmk"
              :data="pmk_data"
              :columns="columns_pmk"
              :height="500"
              :sticky-header="stickyHeaders"
              :paginated="isPaginated"
              :per-page="perPage"
              :current-page.sync="currentPage"
              :pagination-simple="isPaginationSimple"
              :pagination-position="paginationPosition"
              :default-sort-direction="defaultSortDirection"
              :pagination-rounded="isPaginationRounded"
              :sort-icon="sortIcon"
              :sort-icon-size="sortIconSize"
              default-sort="hn"
              aria-next-label="Next page"
              aria-previous-label="Previous page"
              aria-page-label="Page"
              aria-current-label="Current page"
              :page-input="hasInput"
              :pagination-order="paginationOrder"
              :page-input-position="inputPosition"
              :debounce-page-input="inputDebounce"
            >
            </b-table>
          </b-tab-item>

          <b-tab-item
            :visible="showBooks"
            label="ข้อมูลจาก Data center อำเภอ (JHCIS)"
          >
            <b-table
              :loading="isLoading_jhcis"
              :data="jhcis_data"
              :columns="columns_jhcis"
              :height="500"
              :sticky-header="stickyHeaders"
              :paginated="isPaginated"
              :per-page="perPage"
              :current-page.sync="currentPage"
              :pagination-simple="isPaginationSimple"
              :pagination-position="paginationPosition"
              :default-sort-direction="defaultSortDirection"
              :pagination-rounded="isPaginationRounded"
              :sort-icon="sortIcon"
              :sort-icon-size="sortIconSize"
              default-sort="hn"
              aria-next-label="Next page"
              aria-previous-label="Previous page"
              aria-page-label="Page"
              aria-current-label="Current page"
              :page-input="hasInput"
              :pagination-order="paginationOrder"
              :page-input-position="inputPosition"
              :debounce-page-input="inputDebounce"
            >
            </b-table>
          </b-tab-item>
        </b-tabs>
      </div>
      <footer class="card-footer">
        <div class="card-footer-item">
          <span>
            <slot />
          </span>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'BuefyCard',
  data() {
    return {
      activeTab: '0',
      isPaginated: true,
      isPaginationSimple: false,
      isPaginationRounded: false,
      paginationPosition: 'bottom',
      defaultSortDirection: 'asc',
      sortIcon: 'arrow-up',
      sortIconSize: 'is-small',
      currentPage: 1,
      perPage: 10,
      hasInput: false,
      paginationOrder: '',
      inputPosition: '',
      inputDebounce: '',
      height: '1000',
      stickyHeaders: true,
      dateSearchable: false,

      columns_pmk: [
        {
          field: 'OPD_DATE',
          label: 'วันที่รับบริการ',
        },
        {
          field: 'OPDSI',
          label: '#OPDSI',
          centered: true,
        },
        {
          field: 'ICD10',
          label: 'ICD10',
          centered: true,
        },
        {
          field: 'FUOP',
          label: 'FUOP',
          centered: true,
        },
      ],
      columns_jhcis: [
        {
          field: 'DATE_SERV',
          label: 'วันที่รับบริการ',
        },
        {
          field: 'OPDSI',
          label: 'OPDSI',
          centered: true,
        },
        {
          field: 'OPDSI_FU',
          label: 'OPDSI ติดตาม',
          centered: true,
        },
      ],
      pmk_data: '',
      jhcis_data: '',

      isLoading_pmk: false,
      isLoading_jhcis: false,
    }
  },
  mounted() {
    this.activeTab = '1' //ให้ tab run defualt แรก
    this.fetch_pmk()
    this.fetch_jhcis()
  },
  methods: {
    async fetch_pmk() {
      this.isLoading_pmk = true
      await axios
        .post(`${this.$axios.defaults.baseURL}pmk_data.php`)
        .then((response) => {
          this.pmk_data = response.data
          this.isLoading_pmk = false
        })
    },
    async fetch_jhcis() {
      this.isLoading_jhcis = true
      await axios
        .post(`${this.$axios.defaults.baseURL}jhcis_data.php`)
        .then((response) => {
          this.jhcis_data = response.data
          this.isLoading_jhcis = false
        })
    },
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      required: true,
    },
  },
}
</script>
