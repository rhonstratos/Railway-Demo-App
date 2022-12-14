import Swiper, {
	A11y,
	Autoplay,
	Controller,
	EffectCoverflow,
	EffectCube,
	EffectFade,
	EffectFlip,
	EffectCreative,
	EffectCards,
	HashNavigation,
	History,
	Keyboard,
	Lazy,
	Mousewheel,
	Navigation,
	Pagination,
	Parallax,
	Scrollbar,
	Thumbs,
	Virtual,
	Zoom,
	FreeMode,
	Grid,
	Manipulation
} from '@npm/swiper';

window.Swiper = Swiper;
window.Swiper.use([
	A11y,
	Autoplay,
	Controller,
	EffectCoverflow,
	EffectCube,
	EffectFade,
	EffectFlip,
	EffectCreative,
	EffectCards,
	HashNavigation,
	History,
	Keyboard,
	Lazy,
	Mousewheel,
	Navigation,
	Pagination,
	Parallax,
	Scrollbar,
	Thumbs,
	Virtual,
	Zoom,
	FreeMode,
	Grid,
	Manipulation
])

import * as src from './business.script';

class Business {
	constructor() {
		this.collapseNav = src.collapseNav
		this.darkSwitch = src.darkSwitch
		this.changeColor = src.changeColor
		this.changeDateFilter = src.changeDateFilter
		this.changeSort = src.changeSort
		this.showPages = src.showPages
		this.repairOneStatus = src.repairOneStatus,
			this.repairTwoStatus = src.repairTwoStatus,
			this.repairThreeStatus = src.repairThreeStatus,
			this.repairFourStatus = src.repairFourStatus,
			this.repairFiveStatus = src.repairFiveStatus,
			this.setAppointmentApproved = src.setAppointmentApproved,
			this.setAppointmentRejected = src.setAppointmentRejected,
			this.setAppointmentCanceled = src.setAppointmentCanceled,
			this.setAppointment = src.setAppointment
		this.showApptInfo = src.showApptInfo
		this.showAttachments = src.showAttachments
		this.collapseCards = src.collapseCards
		this.repairStatusDropdown = src.repairStatusDropdown
		this.changeRepairStatus = src.changeRepairStatus
		this.activityLogsDropdown = src.activityLogsDropdown
		this.proceedToBillingModal = src.proceedToBillingModal
		this.showRejectMessagePanel = src.showRejectMessagePanel
	}
}

window.Business = Business

import GLightbox from 'glightbox'
window.GLightbox = GLightbox

import TextareaMarkdown from 'textarea-markdown'
window.TextareaMarkdown = TextareaMarkdown

import Chart from 'chart.js/auto'
import * as ChartHelpers from 'chart.js/helpers'
window.Chart = Chart
window.ChartHelpers = ChartHelpers

console.log('defer scripts loaded!')
