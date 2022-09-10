<template>
  <div>
    <nav
      class="navbar header has-shadow is-primary"
      role="navigation"
      aria-label="main navigation"
    >
      <div class="navbar-brand">
        <figure class="image is-64x64 ml-4">
          <img class="is-rounded" src="@/assets/65.gif" />
        </figure>
        <h1 class="is-size-4 ml-4 mt-3">รายงานยอดผู้ป่วยโควิดรายวัน</h1>

        <div class="navbar-burger">
          <span />
          <span />
          <span />
        </div>
      </div>
    </nav>

    <section class="main-content columns">
      <aside class="column is-2 section">
        <p class="subtitle is-5">เมนู</p>
        <ul class="menu-list">
          <li v-for="(item, key) of items" :key="key">
            <NuxtLink :to="item.to" exact-active-class="is-active">
              <b-icon :icon="item.icon" /> {{ item.title }}
            </NuxtLink>
          </li>
        </ul>
      </aside>

      <div class="container column is-10">
        <Nuxt />
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'DefaultLayout',
  data() {
    return {
      items: [
        {
          title: 'ข้อมูลประจำวัน',
          icon: 'chart-bar-stacked ',
          to: { name: 'index' },
        },
        // {
        //   title: 'Inspire',
        //   icon: 'lightbulb',
        //   to: { name: 'inspire' },
        // },
      ],
    }
  },
}
</script>
