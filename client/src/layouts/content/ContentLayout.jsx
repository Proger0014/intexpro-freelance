import { Header } from "../../components/header";
import { Text } from "@mantine/core";

function ContentLayout({ main, titleTop }) {
    return (
        <div>
            <div>
                <Header py={15} logoSize={60}>
                    <Header.Search />
                </Header>

                <Text>{titleTop}</Text>
            </div>
            <main>
                {main}
            </main>
        </div>
    );
}

export default ContentLayout;