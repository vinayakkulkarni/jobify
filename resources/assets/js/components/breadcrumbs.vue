<style size: coped>
.top-menu-bar {
    background: #FFF;
    padding-top: 50px;
    padding-bottom: 10px;
    margin-left: 0px !important;
    margin-right: 0px !important;
    border-bottom: 1px solid rgba(34, 36, 38, .15);
    margin-bottom: 25px !important;
}
</style>
<template>
  <div class="ui fluid top-menu-bar">
    <div class="ui grid inverted container">
      <div class="ten wide left aligned column" style="min-height: 65px;">
        <div class="ui item big breadcrumb" style="margin-top:8px;">
          <span v-for="(breadcrumb, index) in breadcrumbs" v-if="breadcrumbs.length != index + 1">
            <router-link class="section" :to="{ name : breadcrumb.url }" tag="a" exact><i :class="icon" v-if="index == 0"></i> {{ breadcrumb.name }}</router-link>
            <span class="divider">/</span>
          </span>
            <span v-else class="active section"><i :class="icon" v-if="index == 0"></i> {{ breadcrumb.name }}</span>
        </div>
      </div>
      <div class="six wide right aligned column">
        <router-link class="ui red basic button" v-if="discardbutton" :to="{name : discardbutton.name}" exact>Discard</router-link>
        <router-link class="ui green basic button" v-if="applybutton" :to="{name : applybutton.name}" exact>Apply</router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: { 
    breadcrumbs: Array,
    icon: String,
    applybutton: Object,
    discardbutton: Object 
  },
}
</script>