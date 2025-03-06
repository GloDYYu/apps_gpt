export default {
	myVar1: [],
	myVar2: {},
	service_due: () => {
		  		var todayDate =moment().format(moment.HTML5_FMT.DATE)  
          var service_date = List.selectedItem.next_service_due   
           if (todayDate > service_date) {    
                return "Yes"    
            }else {    
                return "No"   
            } 
	},
		next_service: () => {
		     var dt = new Date(DatePicker.formattedDate)
         dt.setMonth( dt.getMonth() + parseInt(interval.text) );	
		     return dt
	},
			today_date: () => {
		  		var todayDate =moment().format(moment.HTML5_FMT.DATE)  
					return todayDate
	}
}