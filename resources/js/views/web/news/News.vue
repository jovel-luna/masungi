<template>
	<div class="width--80 hm-fr8__container inlineBlock-parent margin-a">
		<div class="width--50 hm-fr8__leftCon align-t slideUp">
			<!-- {{-- COMPONENT_NEWS_ARTICLE --}} -->
			<!-- @foreach($news as $index => $news)				 -->

			<div class="hm-fr8__newsCon" :class="'active'" :data-target="`hm--article-${selected.id}`">
				<a :href="selected.link"><div class="hm-fr8__imgCon" :style="{ backgroundImage: `url(${ selected.image_path })` }"></div></a>
				<div class="hm-fr8__textCon" :class="addClass">
					<div class="hm-fr8__text">
						<h3 class="type-1">{{ selected.title }}</h3>
						<!-- {!! $news['description'] !!} -->
						<span v-html="selected.description"></span>
						<a :href="selected.link" target="_blank" style="text-decoration: underline;">{{ selected.link_label }}</a>
					</div>
				</div>
				<a :href="selected.showUrl"><button class="button type-1"  v-if="showReadMore"><span>Read More</span><img src="images/images/icons/arrow.png"></button></a>
			</div>
			<!-- @endforeach -->
			<!-- {{-- END_COMPONENT_NEWS_ARTICLE --}} -->
		</div
		><div class="width--50 hm-fr8__rightCon align-t fadeIn">
			<div class="hm-fr8__wrapper">
				<!-- {{-- COMPONENT_NEWS_TEASER --}} -->
				<!-- @foreach($newsitems as $index => $newsitem) -->
				<!-- Limit to Three articles -->
				<a href="#hm-fr8" v-for="_news in newsList" :data-id="`hm--article-${ _news.id}`" @click="selectNews(_news)">
					<!-- Add active on click -->
					<div class="hm-fr8__newsList">
						<p class="hm-fr8__newsDate font-2">{{ _news.published_date }}</p>
						<p class="font-2">{{ _news.title }} </p>
					</div>
				</a>
				<!-- {{-- END_COMPONENT_NEWS_TEASER --}} -->
				<!-- @endforeach -->
			</div>
			<a href="/news/"><button class="button type-1"><span>View All News</span><img src="images/images/icons/arrow.png"></button></a>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		props: {
			newsList: Array
		},

		data() {
			return {
				selected: this.newsList ? this.newsList[0] : {},
				addClass: 'limit',
				showReadMore: true
			}
		},

		methods: {
			readMore() {
				$('.hm-fr8__newsCon .hm-fr8__textCon').removeClass('limit');
				this.showReadMore = false;
			},

			selectNews(news) {
				$('.hm-fr8__newsCon.active .hm-fr8__textCon').addClass('limit');
				$('.hm-fr8__newsCon .hm-fr8__textCon').removeAttr('style');
				this.selected = news;
				this.addClass = 'limit';
				this.showReadMore = true
			}
		}
	}
</script>