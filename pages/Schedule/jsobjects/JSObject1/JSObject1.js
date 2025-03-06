export default {
	myVar1: [],
	myVar2: {},
	search: () => {
		if(search.text.length==0){
			return select_cars.data
		}
		else{
			return(select_cars.data.filter(word => word.vin.toLowerCase().includes(search.text.toLowerCase())))
		}
	},
		service_due: () => {
		  		var todayDate =moment().format(moment.HTML5_FMT.DATE)  
					return todayDate
	}
}