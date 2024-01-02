import React, { useEffect, useState } from 'react';

interface DataType {
    id: number;
    title: string;
    // Add any other properties based on your actual data structure
}

const Blog: React.FC = () => {
    const [data, setData] = useState<DataType[]>([]);

    useEffect(() => {
        fetchData();
    }, []);

    const fetchData = async () => {
        try {
            const response = await fetch('/api/data');
            const result = await response.json();
            setData(result);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    return (
        <div>
            {data.map((item) => (
                <div key={item.id}>{item.title}</div>
            ))}
        </div>
    );
};

export default Blog;
