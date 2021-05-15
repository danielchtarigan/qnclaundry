jQuery(function ($) {
	let dataSales = {};
	let salesCategory;

	let pItems = JSON.parse(window.localStorage.getItem("dataItem"));

	dataSales.timezone = getTimeZone();
	dataSales.branch = branchId;
	dataSales.outlet = outlet;
	dataSales.user = userId;

	function sumPrice(data) {
		if (data.name === "Cuci Kering") {
			total = data.price;
		} else {
			total =  parseFloat(data.price * data.quantity);
		}

		return total;
	}

	function sumTotal(data) {
		let total = 0;
		$.map(data, function (e) {
			if (e.name === "cuci_kering") {
				total += parseFloat(e.price);
			} else {
				total += parseFloat(e.price * e.quantity);
			}
		});

		return total;
	}

	function changeQuantity(data, name, weight) {
		$.each(data, function (i, val) {
			if (val.name === name) {
				val.quantity = weight;
			}
		});

		return data;
	}

	function orderDetailHtml(data) {
		let html = $(".choose-item.show").find(".detail-order");
	
		$(html).find(".detail-body>.table-detail-item tbody>tr").remove();
		$(html).find(".detail-footer>.table-detail-item.other-sale tbody>tr").remove();

		let total = 0;
		let discount = 0;
		let weight = 0;

		if (data.items) {
			$.each(data.items, function (i, val) {
				if (dataSales.category === 1) {
					weight = val.quantity;
				}

				let name = toFirstWords(val.name.replace(/_/g, ' '));
				let data = { name: name, price: val.price, quantity: val.quantity };
				let tableBody = '<tr><td><a href="#" id="removeItem" data-id="'+ i +'" data-sale="items"><i class="ace-icon fa fa-times"></i></a></td><td>'+ name + ' ' + val.quantity +'</td><td align="right">'+ rupiah(sumPrice(data)) +'</td></tr>';
				$(html).find(".detail-body>.table-detail-item").append(tableBody);
			});
			
			total += sumTotal(data.items);
		}

		if (data.discounts) {
			$(html).find(".detail-footer>.table-detail-item").find("#discount").text("("+rupiah(sumTotal(data.discounts))+")");
			discount += sumTotal(data.discounts);
			total -= discount;
		}

		if (data.membership === "Membership") {
			let member;
			member = sumTotal(data.items) * 0.2;
			dataSales.membership = member;
			total -= member;
			discount += member;

			let tableBody = '<tr><td>Membership</td><td></td><td align="right">('+ rupiah(member) +')</td></tr>';
				$(html).find(".detail-footer>.table-detail-item.other-sale").append(tableBody);
		}
	
		if (data.express) {
			$.each(data.express, function (i, val) {
				let name = toFirstWords(val.name.replace(/_/g, ' '));
				let data = { name: name, price: val.price, quantity: val.quantity };
				let tableBody = '<tr><td><a href="#" id="removeItem" data-id="'+ i +'" data-sale="express"><i class="ace-icon fa fa-times"></i></a> &nbsp; '+ name +'</td><td></td><td align="right">'+ rupiah(sumPrice(data)) +'</td></tr>';
				$(html).find(".detail-footer>.table-detail-item.other-sale").append(tableBody);
			});
			total += sumTotal(data.express);
		}	
		
		if (data.extras) {
			$.each(data.extras, function (i, val) {
				let name = toFirstWords(val.name.replace(/_/g, ' '));
				let data = { name: name, price: val.price, quantity: val.quantity };
				let tableBody = '<tr><td><a href="#" id="removeItem" data-id="'+ i +'" data-sale="extras"><i class="ace-icon fa fa-times"></i></a> &nbsp; '+ name + ' ' + val.quantity +'</td><td></td><td align="right">'+ rupiah(sumPrice(data)) +'</td></tr>';
				$(html).find(".detail-footer>.table-detail-item.other-sale").append(tableBody);
			});					
	
			total += sumTotal(data.extras);
		} else {
			total += 0;
		}	

		dataSales.total = total;
		dataSales.discount = discount;
		dataSales.weight = weight;
	
		$(html).find(".detail-footer>.table-detail-item").find("#subTotal").text(rupiah(sumTotal(data.items)));
		$(html).find(".total #totalOrder").text(rupiah(total));
	};


	$("html body").on("keypress keyup blur", "#quantity, #weight", function (event) {
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	$("html body").on("keyup", "#addItem>#weight", function () {
		let id = $(this).closest(".show").attr("id");
		let name = $(this).closest("a.list-group-item").data("name");
		weight = $(this).val();

		$(this).on("blur", function () {
			if (weight == 0 || weight == "") {
				$(this).closest("#addItem").find("i").show();
				$(this).remove();
			}
		});

		if (id === "salesOrderKiloan") {
			sName = toFirstWords(name.replace(/_/g, ' '));
			newItems = $.grep(pItems.data, e => e.item === sName);

			if (newItems[0].custom.length > 0) {
				p = $.grep(newItems[0].custom, val => val.maxqty >= weight);
				price = p[0].price;
				
				$(this).closest("a.list-group-item").find("#value").attr("data-value", price);
				$(this).closest("a.list-group-item").find("#value").text(rupiah(price));

				$.each(dataSales.items, function (i, val) {
					if (val.name === name) {
						val.price = price;
					}
				});
			}

			changeQuantity(dataSales.items, name, weight);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
		} 
		if (id === "salesOrderPotongan") {
			changeQuantity(dataSales.items, name, weight);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
		} 
		if (id === "salesExtraService") {
			changeQuantity(dataSales.extras, name, weight);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.extras)));
		}
	});

	$("html body").on("click", ".choose-item .list-group-item", function() {
		id = $(this).closest(".show").attr("id");
		let name = $(this).find("#name").text();
		let val = $(this).find("#value").data("value");

		if (id === "salesCategory") {
			dataSales.category = val;
		}
		if (id === "salesOrderCategoryPotongan") {
			let potongan = [];
			name = $(this).data("name");

			potongan.push({
				name: name
			});

			dataSales.potongan = name;
		}

		if (id === "salesOrderKiloan") {          
			let items = [];
			$(this).closest("#selectItem").find("a.list-group-item").each(function (i) {
				name = $(this).data("name");
				weight = $(this).find("#weight").val();
				val = $(this).find("#value").data("value");
				custom = 0;

				sName = toFirstWords(name.replace(/_/g, ' '));
				newItems = $.grep(pItems.data, e => e.item === sName);
				
				if (weight > 0) {
					if (newItems[0].custom.length > 0) {
						p = $.grep(newItems[0].custom, val => val.maxqty >= weight);
						price = p[0].price;
	
						val = price;
						custom = 1;
					}

					items.push(
						{ "name": name, "quantity": weight, "price": val, "category": "Kiloan", "custom": custom }
					);
				}
			});

			dataSales.items = items;
			$("#"+id).find("#labelPrice").text(`${items.length} item`);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
		}
		if (id === "salesOrderPotongan") {          
			let items = [];
			$(this).closest("#selectItem").find("a.list-group-item").each(function (i) {
				name = $(this).data("name");
				quantity = $(this).find("#weight").val();
				val = $(this).find("#value").data("value");

				category = toFirstWords(dataSales.potongan.replace(/_/g, ' '));

				if (quantity > 0) {
					items.push(
						{ "name": name, "quantity": quantity, "price": val, "category": category, "custom": 0 }
					);
				}
			});

			dataSales.items = items;
			$("#"+id).find("#labelPrice").text(`${items.length} item`);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
		}
		if (id === "salesExtraService") {
			let extras = [];
			$(this).closest("#selectItem").find("a.list-group-item").each(function (i) {
				name = $(this).data("name");
				weight = $(this).find("#weight").val();
				val = $(this).data("value");

				if (weight > 0) {
					extras.push(
						{ "name": name, "quantity": weight, "price": val, "category": "Extra Service" }
					);
				}
			});

			dataSales.extras = extras;
			$("#"+id).find("#labelPrice").text(`${extras.length} item`);
			$("#"+id).find("#totalPrice").text(rupiah(sumTotal(dataSales.extras)));
		}

		if (id === "expressService") {
			let express = [];
			name = $(this).data("name");

			switch (name) {
				case "express": price = 15000;
					break;
				case "double_express": price = 30000;
					break;
				case "triple_express": price = 45000;
					break;
			
				default: price = 0;
					break;
			}

			express.push({
				"name": name, "quantity": 1, "price": price, "category": "Express"
			});

			dataSales.express = express;

			$("#"+id).find("#labelPrice").text(`${toFirstWords(express[0].name.replace(/_/g, ' '))}`);
			$("#"+id).find("#totalPrice").text(rupiah(express[0].price));
		}

		if (id === "salesOrderDiscount") {
			let discounts = [];
			val = $(this).data("value");			
			
			if (val) {
				$(this).closest(".show").find("#promoCode").prop("disabled", false);

				$("#promoCode").on("keypress", function (e) {
					if (e.which === 13) {
						let code = $(this).val().toString().toUpperCase();
						$("#discValue").val("");

						apiData("PromoCode/get_code/"+ code, { }, function (data) {
							if (data.readyState === 0) {
								$("#discValue").val("Memeriksa kode...");
							}
							else {
								let valid = true;
								let getData = data.data;

								if (getData) {

									if (getData.kota != "All" && getData.kota != branch) {
										valid = false;    
										alert("Kode promo tidak berlaku di cabang ini!");                  
									}
									if (getData.outlet != "All" && getData.outlet != outlet) {
										valid = false;
										alert("Kode promo tidak berlaku di outlet ini!");        
									}
									orderCategory = dataSales.category === 1 ? "k" : (dataSales.category === 2 ? "p" : "r");
									if (getData.kategori_item != "All" && getData.kategori_item != orderCategory) {
										valid = false;
										alert("Kode promo tidak berlaku untuk "+orderCategory);
									}
									if (getData.min_order > sumTotal(dataSales.items)) {
										valid = false;
										alert("Kode promo berlaku jika minimal pesanan "+rupiah(getData.min_order));
									}

									if (valid == true) {
										
										if (getData.diskon > 0) {
											discount = sumTotal(dataSales.items) * (getData.diskon/100);

											discounts.push({
												"name": "Diskon Promo " + code , "quantity": 1, "price": discount, "category": "Discount" 
											});

											$("#discValue").val(discount);

											dataSales.discounts = discounts;
										}                        
									}

								} 
								else {
									alert("Kode promo sudah kadaluarsa...");
									$("#discValue").val("");
								}
							}
						});
					}
				});

			}
		}

		$(this).addClass("active");
		$(".list-group-item").not(this).each(function () {
			if (id === "salesCategory") {
				$.grep(dataSales.category, e => e == val);
			}
			$(this).removeClass("active");
		});

		$(this).closest(".choose-item").find("#nextstep").prop("disabled", false);

	});
	
	$("html body").on("click", ".create-order #addItem>i", function () {
		$(this).hide();
		input = '<input type="text" name="weight" id="weight" class="form-control" value="1" autocomplete="off"></input>';
		$(this).closest("#addItem").append(input);
	});

	$("html body").on("click", ".backstep", function (e) {
		let id = $(".choose-item.show").attr("id");

		if (id === "salesOrderKiloan") {
			backTo = "salesCategory";
		}
		if (id === "salesOrderCategoryPotongan") {
			backTo = "salesCategory";
		}
		if (id === "salesOrderPotongan") {
			backTo = "salesOrderCategoryPotongan";			
		}
		if (id === "salesExtraService") {
			if (dataSales.category === 1) {
				backTo = "salesOrderKiloan";
				items = $.grep(pItems.data, e => e.type === "Kiloan");	
			} else if (dataSales.category === 2) {
				backTo = "salesOrderPotongan";
				items = $.grep(pItems.data, e => e.type === "Potongan");
			} else {
				backTo = "salesOrderRetail";
				items = $.grep(pItems.data, e => e.type === "Retail");	
			}
		}
		if (id === "expressService") {
			backTo = "salesExtraService";
		}
		if (id === "salesOrderDiscount") {
			backTo = "expressService";
		}
		if (id === "salesOrderDetail") {
			backTo = "salesOrderDiscount";
		}
		
		$(".create-order").animate({
			"left": "-150%"
		}, function () {
			$(this).load("views/sales/"+backTo+".php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				
				if (backTo === "salesCategory") {
					$("html body").find(".ui-widget-header").append('<span id="ui-id-1" class="ui-dialog-title">Buat Pesanan</span>');
				} else {
					$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
				}

				if (backTo === "salesOrderKiloan") {
					$.each(items, function (i, val) {
						let name = val.item.replace(/\s+/g, '_').toLowerCase();
						listElement = `<a href="#" class="list-group-item" data-name="${name}"><div class="flex-row" style="align-items: center;"><div><h4 class="list-group-item-heading">${val.item}</h4><p class="list-group-item-text"><b id="value" data-value="${val.price}" class="text-red">${rupiah(val.price)}</b></p></div><div class="col-xs-3" align="right" id="addItem"><i class="ace-icon fa fa-plus-circle" style="font-size: 20px;" aria-hidden="true"></i></div></div></a>`;
						
						$("html body").find(".show #selectItem").append(listElement);
					});

					if (dataSales.items.length > 0) {
						$.each(dataSales.items, function (i, val) {
							input = '<input type="text" name="weight" id="weight" class="form-control" value="1" autocomplete="off"></input>';
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem i").hide();
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem").append($(input).attr("value", val.quantity));
						});

						$("#"+backTo).find("#labelPrice").text(`${dataSales.items.length} item`);
						$("#"+backTo).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
					}
				}
				
				if (backTo === "salesOrderCategoryPotongan") {
					let items = $.grep(pItems.data, e => e.type === "Potongan");
					let map = items.reduce(function (result, item) {
						result[item.category] = result[item.category] || [];
						result[item.category].push({'name': item.item, 'price': item.price});
						return result;
					}, {});
					
					let potongan = Object.keys(map);  

					$.each(potongan, function (i, val) {
						let name = val.replace(/\s+/g, '_').toLowerCase();
						listElement = `<a href="#" class="list-group-item" data-name="${name}"><h4 class="list-group-item-heading">${val}</h4></a>`;
						
						$("html body").find(".show #selectItem").append(listElement);
					});
				}

				if (backTo === "salesOrderPotongan") {
					let items = $.grep(pItems.data, e => e.category == toFirstWords(dataSales.potongan.replace(/_/g, ' ')));
					$.each(items, function (i, val) {
						let name = val.item.replace(/\s+/g, '_').toLowerCase();
						listElement = `<a href="#" class="list-group-item" data-name="${name}"><div class="flex-row" style="align-items: center;"><div><h4 class="list-group-item-heading">${val.item}</h4><p class="list-group-item-text"><b id="value" data-value="${val.price}" class="text-red">${rupiah(val.price)}</b></p></div><div class="col-xs-3" align="right" id="addItem"><i class="ace-icon fa fa-plus-circle" style="font-size: 20px;" aria-hidden="true"></i></div></div></a>`;
						
						$("html body").find(".show #selectItem").append(listElement);
					});

					if (dataSales.items.length > 0) {
						$.each(dataSales.items, function (i, val) {
							input = '<input type="text" name="weight" id="weight" class="form-control" value="1" autocomplete="off"></input>';
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem i").hide();
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem").append($(input).attr("value", val.quantity));
						});

						$("#"+backTo).find("#labelPrice").text(`${dataSales.items.length} item`);
						$("#"+backTo).find("#totalPrice").text(rupiah(sumTotal(dataSales.items)));
					}
				}

				if (backTo === "salesExtraService") {
					if (dataSales.extras) {
						$.each(dataSales.extras, function (i, val) {
							input = '<input type="text" name="weight" id="weight" class="form-control" value="1" autocomplete="off"></input>';
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem i").hide();
							$("a.list-group-item[data-name='"+val.name+"']").find("#addItem").append($(input).attr("value", val.quantity));
						});

						$("#"+backTo).find("#labelPrice").text(`${dataSales.extras.length} item`);
						$("#"+backTo).find("#totalPrice").text(rupiah(sumTotal(dataSales.extras)));
					}

					$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
				} 

				if (backTo === "expressService") {
					if (dataSales.express) {
						$.each(dataSales.express, function (i, val) {
							let name = val.name.replace(/\s+/g, '_').toLowerCase();
							$("a.list-group-item[data-name='"+name+"']").addClass("active");
						});

						$("#"+backTo).find("#labelPrice").text(`${dataSales.express.length} item`);
						$("#"+backTo).find("#totalPrice").text(rupiah(sumTotal(dataSales.express)));
					}

					$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
				}

				if (backTo === "salesOrderDiscount") {
					if (dataSales.discount) {
						$("#"+backTo).find("#discValue").val(rupiah(dataSales.discount));
					}
					$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
				}

			}).animate({
				"left": "0",
			}, 1000);
		})
	
	});

	$("html body").on("click", ".sales-category #nextstep", function () {

		let val = $("#salesCategory .active #value").data("value");
		salesCategory = val;

		if (salesCategory === 1) {
			html = "salesOrderKiloan";
			items = $.grep(pItems.data, e => e.type === "Kiloan");			
		} else if (salesCategory === 2) {
			html = "salesOrderCategoryPotongan";
			items = $.grep(pItems.data, e => e.type === "Potongan");
		} else if (salesCategory === 2) {
			html = "salesOrderCategoryLinen";
			items = $.grep(pItems.data, e => e.type === "Corporate");
		} else {
			html = "salesOrderRetail";
			items = $.grep(pItems.data, e => e.type === "Retail");
		}
		
		$(".create-order").animate({
			"left": "-150%"
		}, function() {
			$(this).load("views/sales/"+html+".php", function () {
				if (html === "salesOrderCategoryPotongan") {
					let map = items.reduce(function (result, item) {
						result[item.category] = result[item.category] || [];
						result[item.category].push({'name': item.item, 'price': item.price});
						return result;
					}, {});
					
					let categories = Object.keys(map);   

					$.each(categories, function (i, val) {
						let name = val.replace(/\s+/g, '_').toLowerCase();
						listElement = `<a href="#" class="list-group-item" data-name="${name}"><h4 class="list-group-item-heading">${val}</h4></a>`;
						
						$("html body").find(".show #selectItem").append(listElement);
					});
				} else {
					$.each(items, function (i, val) {
						let name = val.item.replace(/\s+/g, '_').toLowerCase();
						listElement = `<a href="#" class="list-group-item" data-name="${name}"><div class="flex-row" style="align-items: center;"><div><h4 class="list-group-item-heading">${val.item}</h4><p class="list-group-item-text"><b id="value" data-value="${val.price}" class="text-red">${rupiah(val.price)}</b></p></div><div class="col-xs-3" align="right" id="addItem"><i class="ace-icon fa fa-plus-circle" style="font-size: 20px;" aria-hidden="true"></i></div></div></a>`;
						
						$("html body").find(".show #selectItem").append(listElement);
					});
				}

				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
			})
			.animate({
				"left": "0",
			}, 1000);
		});	
	});

	$("html body").on("click", ".sales-order-kiloan #nextstep", function () {
		let val = $("#salesOrderKiloan .active #value").data("value");

		$(".create-order").animate({
			"left": "-150%"
		}, function () {
			$(this).load("views/sales/salesExtraService.php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
				$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
			})
			.animate({
				"left": "0",
			}, 1000);
		});
		
	});

	$("html body").on("click", ".sales-order-category-potongan #nextstep", function () {
		$(".create-order").animate({
			"left": "-150%"
		}, function() {
			$(this).load("views/sales/salesOrderPotongan.php", function () {
				let items = $.grep(pItems.data, e => e.category == toFirstWords(dataSales.potongan.replace(/_/g, ' ')));
				$.each(items, function (i, val) {
					let name = val.item.replace(/\s+/g, '_').toLowerCase();
					listElement = `<a href="#" class="list-group-item" data-name="${name}"><div class="flex-row" style="align-items: center;"><div><h4 class="list-group-item-heading">${val.item}</h4><p class="list-group-item-text"><b id="value" data-value="${val.price}" class="text-red">${rupiah(val.price)}</b></p></div><div class="col-xs-3" align="right" id="addItem"><i class="ace-icon fa fa-plus-circle" style="font-size: 20px;" aria-hidden="true"></i></div></div></a>`;
					
					$("html body").find(".show #selectItem").append(listElement);
				});

				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
			})
			.animate({
				"left": "0",
			}, 1000);
		});
	
	});

	$("html body").on("click", ".sales-order-potongan #nextstep", function () {

		$(".create-order").animate({
			"left": "-150%"
		}, function() {
			$(this).load("views/sales/salesExtraService.php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
				$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
			})
			.animate({
				"left": "0",
			}, 1000);
		});
	
	});

	$("html body").on("click", ".sales-extra-service #nextstep", function () {
		$(".create-order").animate({
			"left": "-150%"
		}, function () {
			$(this).load("views/sales/expressService.php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
				$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
			}).animate({
				"left": "0",
			}, 1000);
		})
	
	});

	$("html body").on("click", ".express-service #nextstep", function () {

		$(".create-order").animate({
			"left": "-150%"
		}, function () {
			$(this).load("views/sales/salesOrderDiscount.php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');
				$("html body").find(".choose-item.show").find("#nextstep").prop("disabled", false);
			}).animate({
				"left": "0",
			}, 1000);
		});

	});

	$("html body").on("click", ".sales-order-discount #nextstep", function () {
		$(".create-order").animate({
			"left": "-150%"
		}, function () {
			$(this).load("views/sales/salesOrderDetail.php", function () {
				$("html body").find( ".ui-dialog-title" ).remove();
				$("html body").find( "a.backstep" ).remove();
				$("html body").find(".ui-widget-header").append('<a href="#" class="backstep"><i class="ace-icon fa fa-arrow-circle-left"></i></a>');

				let date = new Date(),
					nowDate = (date.getDate()+"/"+(date.getMonth() + 1)+"/"+date.getFullYear()).toString(),
					nowHour = (date.getHours()+":"+("0" + date.getMinutes()).slice(-2)).toString();

				let customer = JSON.parse(window.localStorage.getItem("dataCustomer"));

				dataSales.customer_name = customer.name;
				dataSales.customer_id = customer.id;

				if (customer.membership === "Membership") {
					dataSales.membership = "Membership";
				}
				
				let html = $(".choose-item.show").find(".detail-order");
				let headingEl = $(`<table width="70%"><tr><td>Nama Pelanggan</td><td>: &nbsp;</td><td id="customer">${dataSales.customer_name}</td></tr><tr><td>Outlet</td><td>: &nbsp;</td><td id="outlet">${outlet}</td></tr><tr><td>Tanggal</td><td>: &nbsp;</td><td id="nowDate">${nowDate}</td></tr><tr><td>Jam</td><td>: &nbsp;</td><td id="nowHour">${nowHour}</td></tr></table>`);

				$(html).find(".detail-heading").append(headingEl);

				orderDetailHtml(dataSales);

			}).animate({
				"left": "0",
			}, 1000);
		});
	});

	$("html body").on("click", "#removeItem", function () {
		let id = $(this).data("id");
		let sale = $(this).data("sale");
		
		switch (sale) {
			case "extras": 
				dataSales.extras.splice(id, 1);
				break;

			case "express": 
				dataSales.express.splice(id, 1);
				break;
				
			default: 
				dataSales.items.splice(id, 1);
				break;
		}

		orderDetailHtml(dataSales);
	});

	$("html body").on("click", "#saveOrder", function() {
		
		apiData("SalesOrder/store/" + dataSales.customer_id, { jsonData: JSON.stringify(dataSales), outlet: outlet }, function (data) {
			if (data.readyState === 0) {
				dialog.dialog("close");
				$("body").append('<div class="areaPrintFaktur" id="areaPrintFaktur"><div class="content" style="margin: 3mm"><div align="center" class="nota-logo"><img width="80%" src="https://new.qnclaundry.com/logo 2017.bmp" /></div></div></div>');
				$(".areaPrintFaktur").addClass('active').append('<div id="load" align="center"><span style="margin-top: -100px"></span></div>');
				$(".areaPrintFaktur>.content").removeClass("show");
			} else {
				$(".areaPrintFaktur").find("#load").remove();
				$(".areaPrintFaktur>.content").addClass("show");

				let order_number = data;

				let dataOutlet = JSON.parse(localStorage.getItem("dataOutlet")).data;
				let dataCustomer = JSON.parse(localStorage.getItem("dataCustomer"));

				let date = new Date(),
					nowDate = (date.getDate()+"/"+(date.getMonth() + 1)+"/"+date.getFullYear()).toString(),
					nowHour = (date.getHours()+":"+("0" + date.getMinutes()).slice(-2)).toString();

				let divContent = `<div style="font-size: 9pt; font-family: Tahoma;" class="content-nota"><div class="struk-body nota-customer"><div class="info-outlet" align="center" style="margin: 20px 0;"></div><div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA ORDER</span></strong></div><div style="text-align: center"><svg class="barcode"></svg></div><br><table style="border-top: 1px dotted #000;width:100%;" id="info-user"><tr><td><span style="float:left;font-size: 9pt;">${nowDate} ${nowHour}</span></td><td><span style="float:right;font-size: 9pt;" id="user"></span></td></tr></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-extra"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-total"></table><div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;" id="info-estimasi"></div><table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000;font-size: 6pt;font-family: Tahoma;text-align: justify;"><tr><td colspan="2">Syarat dan ketentuan komplain klik:</td></tr><tr valign="top"><td style="text-align: center; font-size: 8pt">www.qnclaundry.net/complaint</td></tr><tr valign="top"><td style="text-align: center"><img style="width: 10px" src="../../accounting/icon/hand-pointer.ico"></td></tr></table><div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">Saya setuju dan telah  mengerti seluruh syarat dan ketentuan di QnCLaundry<br><br><br><br><br><br><span id="customerSign" style="display: inline-block; line-height: 0;"></span></div></div></div>`;

				let contentOpr = `<div style="page-break-before:always;" class="struk-body"><table style="width:100%;" id="info-important" align="center"></table><h2 id="outlet" style="font-weight: 3rem; margin-top: -4px; text-align: right"></h2><table style="border-top: 1px dotted #000;width:100%;" id="info-user"><tr><td><span style="float:left;font-size: 9pt;">${nowDate} ${nowHour}</span></td><td><span style="float:right;font-size: 9pt;" id="user"></span></td></tr></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-extra"></table><table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-total"></table><div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;" id="info-estimasi"></div><br><div style="text-align: center"><svg class="barcode"></svg></div></div>`;

				let divOutlet = `<div><p style="line-height: 0.5;">Outlet: ${dataOutlet.outlet}<b></b></p><p style="line-height: 0.5;">Alamat: ${dataOutlet.address}</p><p>Cabang: ${dataOutlet.branch}</p><p style="line-height: 0.5;">Call Center: ${dataOutlet.telpon}</p></div>`;
				let divCustomer = `<tr><td>Nama</td><td>:</td><td>${dataCustomer.name}</td></tr><tr><td>No Pesanan</td><td>:</td><td>${order_number}</td></tr>`;

				$(".areaPrintFaktur>.content").append(divContent);
				$(".content-nota").append(contentOpr);

				$(".info-outlet").html(divOutlet);
				$(".struk-body #info-customer").html(divCustomer);
				$("#info-user #user").text("Kasir: "+ userId);

				let total = 0;
				$.each(dataSales.items, function (i, val) {  
					let name = toFirstWords(val.name.replace(/_/g, ' '));
					let qty = val.category == 1 ? parseFloat(val.quantity)+" kg" : parseFloat(val.quantity);
					let data = { name: name, price: val.price, quantity: val.quantity };
					let content = `<tr><td>${name} ${qty}</td><td align="right">${rupiah(sumPrice(data))}</td></tr>`;
					$(".struk-body #info-order").append(content);
				});
				total += sumTotal(dataSales.items);

				if (dataSales.membership) {
					let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>Membership</td><td align="right">${rupiah(dataSales.membership)}</td></tr>`;
					$(".struk-body #info-extra").append(content);
					total -= dataSales.membership;
				}

				if (dataSales.discounts) {
					$.each(dataSales.discounts, function (i, val) {
						let name = toFirstWords(val.name.replace(/_/g, ' '));
						let data = { name: name, price: val.price, quantity: val.quantity };
						let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${name}</td><td align="right">${rupiah(sumPrice(data))}</td></tr>`;
						$(".struk-body #info-extra").append(content);
					});
					total -= sumTotal(dataSales.discounts);
				}

				if (dataSales.extras) {
					$.each(dataSales.extras, function (i, val) {
						let name = toFirstWords(val.name.replace(/_/g, ' '));
						let data = { name: name, price: val.price, quantity: val.quantity };
						let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${val.name}</td><td align="right">${rupiah(sumPrice(data))}</td></tr>`;
						$(".struk-body #info-extra").append(content);
					});
					total += sumTotal(dataSales.extras);
				}

				let expp = false;
				if (dataSales.express) {
					$.each(dataSales.express, function (i, val) {
						expp = val.name;
						let name = toFirstWords(val.name.replace(/_/g, ' '));
						let data = { name: name, price: val.price, quantity: val.quantity };
						let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${val.name}</td><td align="right">${rupiah(sumPrice(data))}</td></tr>`;
						$(".struk-body #info-extra").append(content);
					});
					total += sumTotal(dataSales.express);
				}

				let divTotal = `<tr><td>Total</td><td align="right"><b>${rupiah(total)}</b></td></tr>`;
				$(".struk-body #info-total").append(divTotal);  

				let divEstimated;
				if (expp == "express") {
					divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(24))}</span>`;
					exp = "Express 24 Jam";
				} else if (expp == "double_express") {
					divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(12))}</span>`;
					exp = "Express 12 Jam";
				} else if (expp == "triple_express") {
					divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(6))}</span>`;
					exp = "Express 6 Jam";
				} else {
					divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(3*24))}</span>`;
					exp = "";
				}

				let divImportant = `<tr><td width="50%"><h3>${exp}</h3></td><td align="right" width="50%"><h3>${nowDate} ${nowHour}</h3></td></tr>`;

				JsBarcode(".barcode", order_number, {
					height: 60,
					textAlign: "center"
				});

				$(".struk-body #info-estimasi").html(divEstimated);
				$(".struk-body #info-important").html(divImportant);
				$("#customerSign").text((dataSales.customer_name).toUpperCase());
				
				let el = $(".areaPrintFaktur").html();
				document.body.innerHTML = el;
				window.print();
				$(".areaPrintFaktur").removeClass("active");
				$("body").find(".areaPrintFaktur").remove();
				location.reload();
			}

		});

	});

  });