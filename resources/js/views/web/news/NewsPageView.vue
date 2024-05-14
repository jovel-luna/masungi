<template>
	<div>
		<section class="page-innerFrame newsAr-fr1 bg-white frame1">
			<div class="page-container">
				<div class="width--90 margin-a newsAr-fr1__list">
					<div class="page-innerFrame__title align-c">
						<h5 class="slideUp">More</h5>
						<h1 class="slideUp">News</h1>
					</div>
					<div class="newsAr-fr1__imgCon slideUp" :style="{ backgroundImage: `url(${ item.image_path })` }"></div>
					<div class="page-general width--80 margin-a newsAr-fr1__titleCon fadeIn">
						<h2 class="slideUp font-2">{{ item.title }}</h2>
						<h5 class="slideUp font-1">{{ item.published_date }}</h5>
			
						<div class="margin-a m-margin-t newsAr-fr1__con slideUp frm-desc">
							<p v-html="item.description"></p>
						</div>
						<a href="/news"><button class="page__prev button type-1"><img src="images/images/icons/arrow.png"><span>Go Back</span></button></a>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script type="text/javascript">
export default{
	props: {
		item: {
			type: Object,
			default: {},
		},
	},
}
</script>