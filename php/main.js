let id = $("input[name*='champion_id']");
id.attr("readonly", "readonly");

$(".btnedit").click((e) => {
  let textValues = displayData(e);
  let championName = $("input[name*='champion_name']");
  let championDescription = $("input[name*='champion_description']");
  let championPrice = $("input[name*='champion_price']");

  id.val(textValues[0]);
  championName.val(textValues[1]);
  championDescription.val(textValues[2]);
  championPrice.val(textValues[3].replace("$", ""));
});

function displayData(e) {
  let id = 0;
  const td = $("#tbody tr td");
  let textValues = [];

  for (const value of td) {
    if (value.dataset.id == e.target.dataset.id) {
      textValues[id++] = value.textContent;
    }
  }
  return textValues;
}
