
function RoomsSelect({ type, count, setData, setSumPeople, capacity, sumCapacity, setSumCapacity }) {

    const genetateOptions = (count) => {
        const options = [];
        for (let i = 1; i <= count; i++) {
            options.push(i);
        }
        return options;
    };

    const handleSelectChange = (e) => {
        setData(type, e.target.value);
        setSumCapacity((prevSumCapacity) => {
            const updateSumCapacity = {...prevSumCapacity, [type]: capacity*e.target.value};
            let total = Object.values(updateSumCapacity).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            setSumPeople(total);
            return updateSumCapacity;
        });
    }

    return (
        <div className="flex justify-between w-full sm:max-w-md my-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div>
                {type === "single"
                    ? "シングルベッド"
                    : type === "twin"
                    ? "ツインベッド"
                    : type === "double"
                    ? "ダブルベッド"
                    : type === "two"
                    ? "二人部屋"
                    : type === "four"
                    ? "四人部屋"
                    : ""}
            </div>
            <div>
                <select
                    className="py-0"
                    name={type}
                    id={type}
                    onChange={handleSelectChange}
                >
                    <option value="0">宿泊する部屋数を選択してください</option>
                    {genetateOptions(count).map((option) => {
                        return (
                            <option key={option} value={option}>
                                {option}部屋
                            </option>
                        );
                    })}
                </select>
            </div>
        </div>
    );
}

export default RoomsSelect;
