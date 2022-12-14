//doubleNavigation script
function collapseNav() {
    if (document.getElementById("navCheckbox").checked) {
        document.getElementById("sideNav").style.left = "0%";
    }
    else {
        document.getElementById("sideNav").style.left = "-100%";
    }
}

function darkSwitch() {
    if (document.getElementById("switch").style.left == "50%") {
        //if it is in dark mode - set to light mode
        document.getElementById("switch").style.left = "0%";
        document.getElementById("sunSwitch").style.color = "#FFFFFF";
        document.getElementById("moonSwitch").style.color = "#67748E";
        // document.getElementById("sunToggle").style.opacity = "1";
        // document.getElementById("moonToggle").style.opacity = "0";
        document.getElementById("darkClassHolder").className = "";
        // document.getElementById("logoLight").style.display = "block";
        // document.getElementById("logoDark").style.display = "none";

		document.getElementById("darkSwitch2bg").style.backgroundColor = "#67748E";
		document.getElementById("darkSwitch2").style.borderColor = "#67748E";
		document.getElementById("darkSwitch2").style.left = "0%";
    } else {
        document.getElementById("switch").style.left = "50%";
        document.getElementById("sunSwitch").style.color = "#A3BDCC";
        document.getElementById("moonSwitch").style.color = "#ffffc3";
        // document.getElementById("sunToggle").style.opacity = "0";
        // document.getElementById("moonToggle").style.opacity = "1";
        document.getElementById("darkClassHolder").className = "dark";
        // document.getElementById("logoLight").style.display = "none";
        // document.getElementById("logoDark").style.display = "block";

		document.getElementById("darkSwitch2bg").style.backgroundColor = "#FF9595";
		document.getElementById("darkSwitch2").style.borderColor = "#FF9595";
		document.getElementById("darkSwitch2").style.left = "50%";
    }
}
//end

//appointment page script
function changeColor(filterOptionId) {
    switch (filterOptionId) {
        case "A1":
            document.getElementById("dotA").style.color = "#344767";
            break;
        case "A2":
            document.getElementById("dotA").style.color = "#5AC5AD";
            break;
        case "A3":
            document.getElementById("dotA").style.color = "#6D3795";
            break;
        case "A4":
            document.getElementById("dotA").style.color = "#FFD272";
            break;
        case "A5":
            document.getElementById("dotA").style.color = "#F03023";
            break;
        case "B1":
            document.getElementById("dotB").style.color = "#344767";
            break;
        case "B2":
            document.getElementById("dotB").style.color = "#5AC5AD";
            break;
        case "B3":
            document.getElementById("dotB").style.color = "#6D3795";
            break;
        case "B4":
            document.getElementById("dotB").style.color = "#FFD272";
            break;
        case "B5":
            document.getElementById("dotB").style.color = "#4BAF61";
            break;
        case "B6":
            document.getElementById("dotB").style.color = "#F03023";
            break;
    }
}

function changeDateFilter(dateFilterId) {
    switch (dateFilterId) {
        case "dateFilterAll":
            //change div
            document.getElementById("dateIconAllOn").style.display = "block";
			document.getElementById("dateIcon1On").style.display = "none";
			document.getElementById("dateIcon2On").style.display = "none";
			document.getElementById("dateIcon3On").style.display = "none";

            document.getElementById("dateIconAllOff").style.display = "none";
			document.getElementById("dateIcon1Off").style.display = "block";
			document.getElementById("dateIcon2Off").style.display = "block";
			document.getElementById("dateIcon3Off").style.display = "block";
            break;
        case "dateFilter1":
            //change div
            document.getElementById("dateIconAllOn").style.display = "none";
			document.getElementById("dateIcon1On").style.display = "block";
			document.getElementById("dateIcon2On").style.display = "none";
			document.getElementById("dateIcon3On").style.display = "none";

            document.getElementById("dateIconAllOff").style.display = "block";
			document.getElementById("dateIcon1Off").style.display = "none";
			document.getElementById("dateIcon2Off").style.display = "block";
			document.getElementById("dateIcon3Off").style.display = "block";
            break;

        case "dateFilter2":
            //change div
            document.getElementById("dateIconAllOn").style.display = "none";
			document.getElementById("dateIcon1On").style.display = "none";
			document.getElementById("dateIcon2On").style.display = "block";
			document.getElementById("dateIcon3On").style.display = "none";

            document.getElementById("dateIconAllOff").style.display = "block";
			document.getElementById("dateIcon1Off").style.display = "block";
			document.getElementById("dateIcon2Off").style.display = "none";
			document.getElementById("dateIcon3Off").style.display = "block";
            break;

        case "dateFilter3":
            //change div
            document.getElementById("dateIconAllOn").style.display = "none";
			document.getElementById("dateIcon1On").style.display = "none";
			document.getElementById("dateIcon2On").style.display = "none";
			document.getElementById("dateIcon3On").style.display = "block";

            document.getElementById("dateIconAllOff").style.display = "block";
			document.getElementById("dateIcon1Off").style.display = "block";
			document.getElementById("dateIcon2Off").style.display = "block";
			document.getElementById("dateIcon3Off").style.display = "none";
            break;
    }
}

function changeSort() {
    if (document.getElementById("sortBy").innerText == "Date & Time") {
        document.getElementById("sortBy").innerText = "Name";
        document.getElementById("dateFilterMenu").style.display = "none";
    } else {
        document.getElementById("sortBy").innerText = "Date & Time";
        document.getElementById("dateFilterMenu").style.display = "flex";
    }
}

function showPages() {
    if (document.getElementById("pages").style.display == "flex") {
        document.getElementById("pages").style.display = "none";
    } else {
        document.getElementById("pages").style.display = "flex";
    }
}

const setAppointmentApproved = (buttonid) => {
    window.$(() => {
        const btn = document.getElementById(buttonid)
        btn.style.flexBasis = "0%";
        btn.style.flexGrow = "1";
        btn.style.backgroundColor = "#4BAF61";
        btn.style.borderColor = "#4BAF61";
        btn.style.color = "white";
        btn.disabled = true;
        document.getElementById("approveSpan").innerText = "Approved";
        document.getElementById("reject").style.display = "none";
        document.getElementById("repairStatusSection").style.display = "block";
        document.getElementById("noticeSection").style.marginBottom = "10px";
        // document.getElementById("canceled").style.display = "flex";
    })
};

const setAppointmentRejected = (buttonid) => {
    const btn = document.getElementById(buttonid)
    btn.style.flexBasis = "0%";
    btn.style.flexGrow = "1";
    btn.style.backgroundColor = "#F56464";
    btn.style.borderColor = "#F56464";
    btn.style.color = "white";
    btn.disabled = true;
    document.getElementById("rejectSpan").innerText = "Reject";
    document.getElementById("approved").style.display = "none";

    // document.getElementById("canceled").style.display = "flex";
	document.getElementById("proceedToBillingButton").style.display = "none";
};

const setAppointmentCanceled = () => {
    //reset approve button
    const approved = document.getElementById("approved")
    approved.style.flexBasis = "";
    approved.style.flexGrow = "";
    approved.style.backgroundColor = "";
    approved.style.border = "";
    approved.style.color = "";
    approved.disabled = false;
    document.getElementById("approveSpan").innerText = "Approve";
    approved.style.display = "";

    //reset reject button
    const rejected = document.getElementById("reject")
    rejected.style.flexBasis = "";
    rejected.style.flexGrow = "";
    rejected.style.backgroundColor = "";
    rejected.style.border = "";
    rejected.style.color = "";
    rejected.disabled = false;
    document.getElementById("rejectSpan").innerText = "Reject";
    rejected.style.display = "";

    //reset repair status section
    document.getElementById("repairStatusSection").style.display = "";
    document.getElementById("noticeSection").style.marginBottom = "";

    //hide close button again
    // document.getElementById("canceled").style.display = "";
};

function showRejectMessagePanel() {
	document.getElementById("rejectionMsgDiv").style.display = "flex";
}

function setAppointment(buttonid) {
    if (buttonid == "approved") {
        setAppointmentApproved(buttonid);
    } else if (buttonid == "confirmRejection") {
        setAppointmentRejected(buttonid);
    } else if (buttonid == "canceled") {
        setAppointmentCanceled();
    }
}

function showApptInfo() {
    //if apptInfoDisp is not displayed on screen
    const apptInfo = document.getElementById("apptInfo");
    const apptInfoContent = document.getElementById("apptInfoContent");
    if (apptInfo.style.left == "0%") {
        apptInfo.style.transitionDuration = "300ms";
        apptInfo.style.backgroundColor = "transparent";
        apptInfoContent.style.transitionDuration = "300ms";
        apptInfoContent.style.right = "-100%";
        apptInfoContent.addEventListener("transitionend", () => {
            if (apptInfoContent.style.right == "-100%") {
                apptInfo.style.transitionDuration = "0ms";
                apptInfo.style.left = "100%";
            }
        });
    } else {
        apptInfoContent.style.transitionDuration = "300ms";
        apptInfo.style.left = "0%";
        apptInfoContent.style.right = "0%";
        apptInfoContent.scrollTop = 0;
        apptInfoContent.addEventListener("transitionstart", () => {
            if (apptInfoContent.style.right == "0%") {
                apptInfo.style.transitionDuration = "300ms";
                apptInfo.style.backgroundColor = "rgba(0,0,0,0.5)";

                apptInfo.addEventListener("transitionend", () => {
                    apptInfo.style.transitionDuration = "0ms";
                    apptInfoContent.style.transitionDuration = "0ms";
                });
            }
        });
    }
}

function showAttachments() {
    if (document.getElementById("attachmentGallery").style.display == "flex") {
        document.getElementById("attachmentGallery").style.display = "none";
    } else {
        document.getElementById("attachmentGallery").style.display = "flex";
    }
}

function collapseCards(id) {
    if (document.getElementById(id).style.display == "none") {
        if (id == "noticeCard") {
            document.getElementById(id).style.display = "block";
        } else if (id == "collapsibleIconsCard" || id == "collapsibleSplashScreensCard") {
            document.getElementById(id).style.display = "grid";
		} else {
            document.getElementById(id).style.display = "flex";
        }
    } else {
        document.getElementById(id).style.display = "none";
    }
}

function repairStatusDropdown() {
    //initially, the checkbox is checked, when clicked, the checkbox will return true first and then goes to false state after
    if (document.getElementById("repairStatusCheckBox").checked == true) {
        document.getElementById("repairStatusList").style.display = "block";
    } else {
        document.getElementById("repairStatusList").style.display = "none";
    }
}

const repairOneStatus = () => {
    document.getElementById("repairStatusButton").innerHTML = "Not yet started";
    document.getElementById("repairStatusDropdown").style.backgroundColor =
        "#5AC5AD";
};

const repairTwoStatus = () => {
    document.getElementById("repairStatusButton").innerHTML = "Repairing";
    document.getElementById("repairStatusDropdown").style.backgroundColor =
        "#6D3795";
};

const repairThreeStatus = () => {
    document.getElementById("repairStatusButton").innerHTML =
        "Waiting for parts";
    document.getElementById("repairStatusDropdown").style.backgroundColor =
        "#FFD272";
};

const repairFourStatus = () => {
    document.getElementById("repairStatusButton").innerHTML = "Completed";
    document.getElementById("repairStatusDropdown").style.backgroundColor =
        "#4BAF61";
};

const repairFiveStatus = () => {
    document.getElementById("repairStatusButton").innerHTML = "Failed repair";
    document.getElementById("repairStatusDropdown").style.backgroundColor =
        "#F03023";
};

function changeRepairStatus(id) {
    switch (id) {
        case "repStats1":
            repairOneStatus();
            break;
        case "repStats2":
            repairTwoStatus();
            break;
        case "repStats3":
            repairThreeStatus();
            break;
        case "repStats4":
            repairFourStatus();
            break;
        case "repStats5":
            repairFiveStatus();
            break;
    }
}

function activityLogsDropdown() {
    if (document.getElementById("activityLogsCheckbox").checked == true) {
        document.getElementById("activityLogsList").style.minHeight =
            "fit-content";
        document.getElementById("activityLogsList").style.maxHeight =
            "fit-content";
    } else {
        document.getElementById("activityLogsList").style.minHeight = "";
        document.getElementById("activityLogsList").style.maxHeight = "";
    }
}

function proceedToBillingModal() {
    if (document.getElementById("proceedToBillingCheckbox").checked == true) {
        document.getElementById("billingModal").style.display = "flex";
    } else {
        document.getElementById("billingModal").style.display = "none";
    }
}
//end

export {
    collapseNav,
    darkSwitch,
    changeColor,
    changeDateFilter,
    changeSort,
    showPages,
    setAppointmentApproved,
    setAppointmentRejected,
    setAppointmentCanceled,
    setAppointment,
    showApptInfo,
    showAttachments,
    collapseCards,
    repairStatusDropdown,
    repairOneStatus,
    repairTwoStatus,
    repairThreeStatus,
    repairFourStatus,
    repairFiveStatus,
    changeRepairStatus,
    activityLogsDropdown,
    proceedToBillingModal,
	showRejectMessagePanel,
};
