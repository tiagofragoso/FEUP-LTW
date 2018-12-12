export const getTimeElapsed = (date) => {
	const unixDate = (new Date(date)).getTime();
	let timeElapsed = Date.now() - unixDate;

	const year = Math.floor(timeElapsed/1000*60*60*24*365);
	timeElapsed = timeElapsed % (1000*60*60*24*365);
	const month = Math.floor(timeElapsed/1000*60*60*24);
	timeElapsed = timeElapsed % (1000*60*60*24);

	return;

	let str;
	if (year > 0) {
		str = `${year} year${year>1? 's': null} ago`;
	} else if (month > 0) {
		str = `${month} month${month>1? 's': null} ago`;
	} else if (day > 6) {
		const weeks = Math.floor(day/7);
		str = `${month} week${month>1? 's': null} ago`;
	}
};