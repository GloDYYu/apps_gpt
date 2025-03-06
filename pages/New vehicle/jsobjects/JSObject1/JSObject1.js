export default {
	myVar1: [],
	myVar2: {},
	next_service: () => {
				if(!last_service.formattedDate) {return ''}
		     var dt = new Date(last_service.formattedDate)
         dt.setMonth( dt.getMonth() + interval.text );	
		     return dt 
	}
}